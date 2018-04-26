<?php
error_reporting(E_ALL); ini_set('display_errors', 1);
include "../includes/connection.php";

$userid = $_POST['user'];
$nummer = $_POST['nummer'];
$merk = $_POST['merk'];
$model = $_POST['model'];
$date = $_POST['datum'];
$waarde = $_POST['prijs'];
$picture = $_POST['uploadFile'];

$folder = "uploads/";
$uploadfolder = "\\WEBSERVER03\PORTAL$\inventadmin\uploads";
$tmp_name = $_FILES["uploadFile"]["tmp_name"][0];
$img = $folder.$picture;

try{
	var_dump(move_uploaded_file($tmp_name, "$uploadfolder/$tmp_name"));
	$stmt = $conn->prepare("INSERT INTO IA_Telefoon (U_ID, Telefoonnummer, Merk, Model, Aanschaf_dat, Aanschaf_waarde, Picture_gsm)
							VALUES (?,?,?,?,?,?,?)");
	$stmt->execute([$userid, $nummer, $merk, $model, $date, $waarde, $img]);
}
catch(PDOException $e){
	echo $stmt . "<br>" . $e->getMEssage();
}
$conn = null;

?>