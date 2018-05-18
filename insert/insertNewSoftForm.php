<html><head><link rel="icon" sizes="32x32" type="image/png" href="../favicon.ico"/><title>Inventadmin</title>
<meta http-equiv="X-UA-Compatible" content="IE=edge;" />
<?php
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
	<H4> Voeg een programma toe</H4>
	<hr>
	<form id='soft_form' action='insertNewSoftForm.php' method='post'>
	<div class="form-group">
		<label class="control-label col-sm-2" for="soft_naam">Softwarenaam:</label>
		<div class="col-sm-10">
			<input type='text' name='soft_naam' placeholder='Software naam' class='form-control' required>
		</div>
	</div>
	<div class="form-group">
		<label class="control-label col-sm-2" for="soft_versie">Versie:</label>
		<div class="col-sm-10">
			<input type='text' name='soft_versie' placeholder='Versie' class='form-control' required>
		</div>
	</div>
		<input type='submit' name='submit4' value='Voeg toe' class='btn btn-success'>
	</form>
</div>
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