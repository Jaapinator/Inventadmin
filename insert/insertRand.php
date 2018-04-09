<?php
error_reporting(E_ALL); ini_set('display_errors', 1);
include "../includes/connection.php";

$comid = $_POST['com_id'];
$rand_merk = $_POST['rand_merk'];
$rand_type = $_POST['rand_type'];
$date = $_POST['datum'];
$waarde = $_POST['prijs'];


try{
	$stmt = $conn->prepare("INSERT INTO IA_Randapparatuur (Com_ID, Merk, Type, Aanschaf_dat, Aanschaf_waarde)
							VALUES (?,?,?,?,?)");
	$stmt->execute([$comid, $rand_merk, $rand_type, $date, $waarde]);
	echo '<meta http-equiv="refresh" content="0;URL=https://portal.basrt.eu/inventadmin/" />';
}
catch(PDOException $e){
	echo $stmt . "<br>" . $e->getMEssage();
	echo '<meta http-equiv="refresh" content="0;URL=https://portal.basrt.eu/inventadmin/insert/insertRandForm.php" />';
}
$conn = null;

?>