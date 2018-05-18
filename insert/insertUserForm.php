<html><head><link rel="icon" sizes="32x32" type="image/png" href="../favicon.ico"/><title>Inventadmin</title>
<meta http-equiv="X-UA-Compatible" content="IE=edge;" /><?php
	include "../includes/connection.php";
	include "../includes/scripts.php";
?>
<style>
input, select{
	max-width: 275px;
}
</style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top">
	<a class="navbar-brand" href="https://portal.basrt.eu/">Inventadmin</a>
	<div class="collapse navbar-collapse" id="navbarNavDropdown">
		<ul class="navbar-nav">
			<li class="nav-item">
				<a class="nav-link" href='../index.php'>Overzicht</a>
			</li>
		</ul>
	</div>
</nav>
<div class="container">
<div class="main-login main-center">
	<H4> Voeg gebruiker toe</H4>
	<hr>
	<form method='post' action='insertUserForm.php'>
	<div class="form-group">
		<label class="control-label col-sm-2" for="gebruiker">Naam:</label>
		<div class="col-sm-10">
			<input type='text' name='gebruiker' placeholder='Gebruiker' class='form-control' required>
		</div>
	</div>
	<div class="form-group">
		<label class="control-label col-sm-2" for="email">E-mail:</label>
		<div class="col-sm-10">
			<input type='text' name='email' placeholder='E-mail' class='form-control' required>
		</div>
	</div>
		<input type='submit' name='submit2' value='Voeg toe' class='btn btn-success' >
	</form>
</div>
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