<html><head><link rel="icon" sizes="32x32" type="image/png" href="../favicon.ico"/><title>Inventadmin</title>
<meta http-equiv="X-UA-Compatible" content="IE=edge;" />
<?php 	include "../includes/connection.php"; 
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
<div class="container">
<div class="main-login main-center">
	<H4>Computer koppelen</H4>
	<hr>
	<form method="post" action="bound.php" id="bound_form">
	<div class="form-group">
		<label class="control-label col-sm-2" for="Dev_ID">Computer barcode:</label>
	<div class="col-sm-10">
	<?php $sql = $conn->query("SELECT Dev_ID, Barcode FROM IA_Devices"); ?>
			<select  name="comid">
				<option style="display:none" value="">Kies computerbarcode</option>
			<?php 	while ($row = $sql->fetch(PDO::FETCH_ASSOC)) {
					   echo '<option value="'.$row['Dev_ID'].'">'.$row['Barcode'].'</option>';
					} ?>
			</select>
		</div>
	</div>
	<div class="form-group">
		<label class="control-label col-sm-2" for="ruimteid">Ruimtenaam:</label>
	<div class="col-sm-10">
	<?php $sql = $conn->query("SELECT Ruimte_ID, Ruimte_naam FROM IA_Locatie"); ?>
			<select  name="ruimteid" required>
				<option style="display:none" value="">Kies ruimtenaam</option>
			<?php	while ($row = $sql->fetch(PDO::FETCH_ASSOC)) {
					   echo '<option value="'.$row['Ruimte_ID'].'">'.$row['Ruimte_naam'].'</option>';
					} ?>
			</select>
		</div>
	</div>
				<a href="insertLocForm.php">Locatie bestaat nog niet? Voeg hem hier toe</a><br><br>
	<div class="form-group">
		<label class="control-label col-sm-2" for="userid">Gebruiker: <i>niet verplicht</i></label>
	<div class="col-sm-10">
	<?php $sql = $conn->query("SELECT U_ID, Gebruiker FROM IA_Gebruiker"); ?>
			<select  name="userid">
				<option style="display:none" value="">Kies gebruiker van de computer</option>
			<?php 	while ($row = $sql->fetch(PDO::FETCH_ASSOC)) {
					   echo '<option value="'.$row['U_ID'].'">'.$row['Gebruiker'].'</option>';
					} ?>
			</select>
		</div>
	</div>
		<input type="submit" name="submit" value="Koppel" class='btn btn-success'>
	</form>
</div>
</div>
</body>
</html>
<?php
if(isset($_POST['submit'])){

$comid = $_POST['comid'];
$userid = $_POST['userid'];
$ruimteid = $_POST['ruimteid'];

	try{
		$stmt = $conn->prepare("INSERT INTO IA_Locatie_RG (Dev_ID, U_ID, Ruimte_ID)
								VALUES (?,?,?)");
		$stmt->execute([$comid, $userid, $ruimteid]);
		echo '<meta http-equiv="refresh" content="0;URL=https://portal.basrt.eu/inventadmin/" />';
	}
	catch(PDOException $e){
		echo $stmt . "<br>" . $e->getMEssage();
		echo '<meta http-equiv="refresh" content="0;URL=https://portal.basrt.eu/inventadmin/insert/insertRandForm.php" />';
	}
$conn = null;
}
?>