<?php

include "includes/connection.php";

$code = $_GET['barcode'];

$result = $conn->prepare("SELECT count(*) FROM IA_Computer WHERE Barcode=:code"); 
$result->bindParam(':code', $code, PDO::PARAM_STR);
$result->execute();
$rowCount = $result->fetchColumn(0);

if($rowCount == 1)
{
$stmt = $conn->prepare('SELECT Com_ID FROM IA_Computer WHERE Barcode=:code'); 
$stmt->bindParam(':code', $code, PDO::PARAM_STR);
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