<?php

include "includes/connection.php";

$code = $_GET['barcode']; 
$stmt = $conn->prepare("
SELECT count(*)
FROM IA_Computer c 
JOIN IA_Monitor m 
ON c.Com_ID = m.Com_ID 
WHERE c.Barcode = :code
OR m.Barcode = :code2"); 
$stmt->bindParam(':code', $code, PDO::PARAM_STR);
$stmt->bindParam(':code2', $code, PDO::PARAM_STR);
$stmt->execute();
$rowCount = $stmt->fetchColumn(0);

if($rowCount >= 1)
{
$stmt = $conn->prepare('
SELECT c.Com_ID 
FROM IA_Computer c 
JOIN IA_Monitor m 
ON c.Com_ID = m.Com_ID 
WHERE c.Barcode = :code 
OR m.Barcode = :code2'); 
$stmt->bindParam(':code', $code, PDO::PARAM_STR);
$stmt->bindParam(':code2', $code, PDO::PARAM_STR);
$stmt->execute();
while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
header ("Location: view.php?view=$row[Com_ID]");
}
}
else
{
echo "<script> alert('Barcode bestaat niet');</script>";
header ("Location: index.php");
}
$conn = null;
?>