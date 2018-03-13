<?php
	include "../includes/connection.php";
?><style><?php
	include "../includes/style.css";
?></style><?php

$soft_id = trim($_POST['soft_id']);
$com_id = trim($_POST['com_id']);
$soft_a_date = trim($_POST['soft_a_date']);
$soft_a_prijs = trim($_POST['soft_a_prijs']);

try {
	$stmt = $conn->prepare("INSERT INTO IA_Software_RG (Soft_ID, Com_ID, Aanschaf_dat, Aanschaf_waarde)
							VALUES (?,?,?,?)");
	$stmt->execute([$soft_id, $com_id, $soft_a_date, $soft_a_prijs]);	
	echo '<meta http-equiv="refresh" content="0;URL=http://webserver03/inventadmin/" />';
}catch(PDOException $e){
	//echo $stmt . "<br>" . $e->getMessage();
	echo "<script>alert('Vul de velden goed in!');</script>";
	echo '<meta http-equiv="refresh" content="0;URL=http://webserver03/inventadmin/insert/insertSoftForm.php" />';
}
$conn = null;
?>