<?php
error_reporting(E_ALL); ini_set('display_errors', 1);
include "../includes/connection.php";

$userid = $_POST['user'];
$nummer = $_POST['nummer'];
$merk = $_POST['merk'];
$model = $_POST['model'];
$date = $_POST['datum'];
$waarde = $_POST['prijs'];


try{
	$stmt = $conn->prepare("INSERT INTO IA_Telefoon (U_ID, Telefoonnummer, Merk, Model, Aanschaf_dat, Aanschaf_waarde)
							VALUES (?,?,?,?,?,?)");
	$stmt->execute([$userid, $nummer, $merk, $model, $date, $waarde]);
	echo '<meta http-equiv="refresh" content="0;URL=https://portal.basrt.eu/inventadmin/" />';
}
catch(PDOException $e){
	echo $stmt . "<br>" . $e->getMEssage();
	echo '<meta http-equiv="refresh" content="0;URL=https://portal.basrt.eu/inventadmin/insert/insertRandForm.php" />';
}
$conn = null;

?>