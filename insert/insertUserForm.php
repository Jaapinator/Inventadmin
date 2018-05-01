<html><head><link rel="icon" sizes="32x32" type="image/png" href="../favicon.ico"/><title>Inventadmin</title>
<meta http-equiv="X-UA-Compatible" content="IE=edge;" /><?php
	include "../includes/connection.php";
?><style><?php
	include "../includes/css/style.css";
?></style>
</head>
<body>
<div class='navbar'>
	<a href='https://portal.basrt.eu/index/login.php'>Portal</a>
	<a href='../index.php'>Overzicht</a>
</div>
<div class='form'>
	<H4> Voeg gebruiker toe</H4>
	<form method='post' action='insertUserForm.php'>
	<label>Naam</label>
		<input type='text' name='gebruiker' placeholder='Gebruiker' required>
	<label>E-mail</label>
		<input type='email' name='email' placeholder='E-mail' required>
		<input type='submit' name='submit2' value='voeg toe'>
	</form>
</div>
</body>
</html>
<?php
if(isset($_POST['submit2'])){
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
}
?>