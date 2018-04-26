<?php
error_reporting(E_ALL); ini_set('display_errors', 1);
	include "../includes/connection.php";
?><style><?php
	include "../includes/style.css";
?></style>
<?php
$com_barcode = $_POST['com_barcode'];
$com_naam = $_POST['com_naam'];
$com_ip = $_POST['com_ip'];
$com_merk = $_POST['com_merk'];
$com_cpu = $_POST['com_cpu'];
$com_ram = $_POST['com_ram'];
$com_serial = $_POST['com_serial'];
$com_a_date = $_POST['com_a_date'];
$com_a_prijs = $_POST['com_a_prijs'];
$comment = $_POST['comment'];

$result = $conn->prepare("SELECT count(*) FROM IA_Computer WHERE Ip_adres=:ip"); 
$result->bindParam(':ip', $com_ip, PDO::PARAM_STR);
$result->execute();
$rowCount = $result->fetchColumn(0);

if($rowCount == 0){
try{
	$stmt = $conn->prepare("INSERT INTO IA_Computer (Barcode, Com_naam, Ip_adres, Com_merk, CPU_naam, Memory, Serialnum, Aanschaf_dat, Aanschaf_waarde, Opmerkingen)
							VALUES (?,?,?,?,?,?,?,?,?,?)");
	$stmt->execute([$com_barcode, $com_naam, $com_ip, $com_merk, $com_cpu, $com_ram, $com_serial, $com_a_date, $com_a_prijs, $comment]);
	echo '<meta http-equiv="refresh" content="0;URL=https://portal.basrt.eu/inventadmin/" />';
}
catch(PDOException $e){
	echo $stmt . "<br>" . $e->getMessage();
	echo '<meta http-equiv="refresh" content="0;URL=https://portal.basrt.eu/inventadmin/insert/insertComForm.php" />';

}
}
else{
	echo "<script> alert('Ip-adres bestaat al');</script>";
	echo '<meta http-equiv="refresh" content="0;URL=https://portal.basrt.eu/inventadmin/insert/insertComForm.php" />';
}
$conn = null;
?>