<html><head><link rel="icon" sizes="32x32" type="image/png" href="../favicon.ico"/><title>Inventadmin</title>
<meta http-equiv="X-UA-Compatible" content="IE=edge;" /><?php 
	include "../includes/connection.php";
	include "../includes/scripts.php";
?>
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
<div class='form'>
	<H4> Voeg een locatie toe</H4>
	<form method='post' action='insertLocForm.php'>
	<label>Locatienaam</label>
		<input type='text' name='ruimte_naam' placeholder='Naam'>
		<input type='submit' name='submit' value='Voeg toe'>
	</form>
</div>
</body>
</html>
<?php
if(isset($_POST['submit'])){
$ruimte_naam = trim($_POST['ruimte_naam']);

try{
	$stmt = $conn->prepare("INSERT INTO IA_Locatie (Ruimte_naam) VALUES (?)");
	$stmt->execute([$ruimte_naam]);
	echo '<meta http-equiv="refresh" content="0;URL=https://portal.basrt.eu/inventadmin/" />';
}catch(PDOException $e){
	echo $e->getMessage();
}
}
$conn = null;
?>