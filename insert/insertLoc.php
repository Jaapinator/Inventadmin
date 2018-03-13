<?php
error_reporting(E_ALL); ini_set('display_errors', 1);
	include "../includes/connection.php";
?><style><?php
	include "../includes/style.css";
?></style>
<?php
$ruimte_naam = trim($_POST['ruimte_naam']);

try{
	$stmt = $conn->prepare("INSERT INTO IA_Locatie (Ruimte_naam) VALUES (?)");
	$stmt->execute([$ruimte_naam]);
	echo '<meta http-equiv="refresh" content="0;URL=http://webserver03/inventadmin/" />';
}catch(PDOException $e){
	echo $e->getMessage();
}
$conn = null;
?>