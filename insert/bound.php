<html><head><link rel="icon" sizes="32x32" type="image/png" href="../favicon.ico"/><title>Inventadmin</title>
<meta http-equiv="X-UA-Compatible" content="IE=edge;" />
<style><?php include "../includes/css/style.css"; ?></style>
<?php include "../includes/connection.php"; ?>
</head>
<body>
<div class="navbar">
	<a href="https://portal.basrt.eu/index/login.php">Portal</a>
	<a href="../index.php">Overzicht</a>
</div>
<div class="form">
	<H4>Computer koppelen</H4>
	<form method="post" action="insertBound.php" id="bound_form">
	<?php $sql = $conn->query("SELECT Com_ID, Barcode FROM IA_Computer"); ?>
		<label>Computerbarcode</label>
			<select  name="comid" required>
				<option style="display:none" value="">Kies computerbarcode</option>
			<?php 	while ($row = $sql->fetch(PDO::FETCH_ASSOC)) {
					   echo '<option value="'.$row['Com_ID'].'">'.$row['Barcode'].'</option>';
					} ?>
			</select>
	<?php $sql = $conn->query("SELECT Ruimte_ID, Ruimte_naam FROM IA_Locatie"); ?>
		<label>Ruimtenaam</label>
			<select  name="ruimteid" required>
				<option style="display:none" value="">Kies ruimtenaam</option>
			<?php	while ($row = $sql->fetch(PDO::FETCH_ASSOC)) {
					   echo '<option value="'.$row['Ruimte_ID'].'">'.$row['Ruimte_naam'].'</option>';
					} ?>
			</select>
				<a href="insertLocForm.php">Locatie bestaat nog niet? Voeg hem hier toe</a><br><br>
	<?php $sql = $conn->query("SELECT U_ID, Gebruiker FROM IA_Gebruiker"); ?>
		<label>Gebruiker <i>niet verplicht</i></label>
			<select  name="userid">
				<option style="display:none" value="">Kies gebruiker van de computer</option>
			<?php 	while ($row = $sql->fetch(PDO::FETCH_ASSOC)) {
					   echo '<option value="'.$row['U_ID'].'">'.$row['Gebruiker'].'</option>';
					} ?>
			</select>
		<input type="submit" name="submit" value="Koppel">
	</form>
</div>
</body>
</html>
<?php
if(isset($_POST['submit'])){

$comid = $_POST['comid'];
$userid = $_POST['userid'];
$ruimteid = $_POST['ruimteid'];

	try{
		$stmt = $conn->prepare("INSERT INTO IA_Locatie_RG (Com_ID, U_ID, Ruimte_ID)
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