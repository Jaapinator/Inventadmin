<?php
error_reporting(E_ALL); ini_set('display_errors', 1);
	include "../includes/connection.php";
?><style><?php
	include "../includes/style.css";
?></style>
<?php

$gebruiker = trim($_POST['gebruiker']);
$mail = trim($_POST['email']);

try{
	$stmt = $conn->prepare("INSERT INTO IA_Gebruiker (Gebruiker, Mailadres)
							VALUES (?,?)");
	$stmt->execute([$gebruiker, $mail]);	
	echo '<meta http-equiv="refresh" content="0;URL=https://portal.basrt.eu/inventadmin/" />';
}catch(PDOException $e){
	?><script>alert("Er is al iemand verbonden aan deze computer!");</script><?php
	echo '<meta http-equiv="refresh" content="0;URL=https://portal.basrt.eu/inventadmin/" />';
}
$conn = null;
?>