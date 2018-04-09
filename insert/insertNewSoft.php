<?php
error_reporting(E_ALL); ini_set('display_errors', 1);
	include "../includes/connection.php";
?><style><?php
	include "../includes/style.css";
?></style>
<?php
$soft_naam = trim($_POST['soft_naam']);
$soft_versie = trim($_POST['soft_versie']);


try{
	$stmt = $conn->prepare("INSERT INTO IA_Software (Soft_naam, Versie)
							VALUES (?,?)");
	$stmt->execute([$soft_naam, $soft_versie]);		
	echo '<meta http-equiv="refresh" content="0;URL=https://portal.basrt.eu/inventadmin/" />';	
}catch(PDOException $e){
	//echo $stmt . "<br>" . $e->getMessage();
	echo "<script>alert('Vul de velden goed in!');</script>";
	echo '<meta http-equiv="refresh" content="0;URL=https://portal.basrt.eu/inventadmin/insert/insertNewSoftForm.php" />';
}
$conn = null;
?>