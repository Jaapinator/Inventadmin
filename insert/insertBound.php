<?php
error_reporting(E_ALL); ini_set('display_errors', 1);
include "../includes/connection.php";

$comid = $_POST['comid'];
$userid = $_POST['userid'];
$ruimteid = $_POST['ruimteid'];

try{
	$stmt = $conn->prepare("INSERT INTO IA_Locatie_RG (Com_ID, U_ID, Ruimte_ID)
							VALUES (?,?,?)");
	$stmt->execute([$comid, $userid, $ruimteid]);
	echo '<meta http-equiv="refresh" content="0;URL=http://webserver03/inventadmin/" />';
}
catch(PDOException $e){
	echo $stmt . "<br>" . $e->getMEssage();
	echo '<meta http-equiv="refresh" content="0;URL=http://webserver03/inventadmin/insert/insertRandForm.php" />';
}
$conn = null;
?>