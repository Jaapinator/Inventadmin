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
	<H4> Voeg een programma toe</H4>
	<form id='soft_form' action='insertNewSoftForm.php' method='post'>
	<label>Softwarenaam</label>
		<input type='text' name='soft_naam' placeholder='Software naam' required>
	<label>Versie</label>
		<input type='text' name='soft_versie' placeholder='Versie' required>
		<input type='submit' name='submit4' value='voeg toe'>
	</form>
</div>
</body>
</html>
<?php
if(isset($_POST['submit4'])){
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
}
$conn = null;
?>