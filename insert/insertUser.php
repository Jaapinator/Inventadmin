<?php
error_reporting(E_ALL); ini_set('display_errors', 1);
	include "../includes/connection.php";
?><style><?php
	include "../includes/style.css";
?></style>
<?php
$com_id = trim($_POST['com_id']);
$gebruiker = trim($_POST['gebruiker']);
$mail = trim($_POST['email']);

try{
	$stmt = $conn->prepare("INSERT INTO IA_Gebruiker (Com_ID, Gebruiker, Mailadres)
							VALUES (?,?,?)");
	$stmt->execute([$com_id, $gebruiker, $mail]);	
	echo '<meta http-equiv="refresh" content="0;URL=https://portal.basrt.eu/inventadmin/" />';
}catch(PDOException $e){
	?><script>alert("Er is al iemand verbonden aan deze computer!");</script><?php
	echo '<meta http-equiv="refresh" content="0;URL=https://portal.basrt.eu/inventadmin/" />';
}
$conn = null;
?>