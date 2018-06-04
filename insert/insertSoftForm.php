<html><head><link rel="icon" sizes="32x32" type="image/png" href="../favicon.ico"/><title>Inventadmin</title>
<meta http-equiv="X-UA-Compatible" content="IE=edge;" /><?php
error_reporting(E_ALL); ini_set('display_errors', 1);
	include "../includes/connection.php";
	include "../includes/scripts.php";
?><script>
	$(document).ready(function($){
		
		$('#money').mask('#.##0.00', {reverse: true});
		
	});
</script>
<script>
$(function(){
    var dtToday = new Date();
    
    var month = dtToday.getMonth() + 1;
    var day = dtToday.getDate();
    var year = dtToday.getFullYear();
    if(month < 10)
        month = '0' + month.toString();
    if(day < 10)
        day = '0' + day.toString();
    
    var maxDate = year + '-' + month + '-' + day;
    $('#picker').attr('max', maxDate);
});
</script>
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
	<H4> Voeg een nieuw programma toe</H4>
	<hr>
	<form id='soft_form' action='insertSoftForm.php' method='post'>
	<div class="form-group">
		<label class="control-label col-sm-2" for="Dev_ID">Computer barcode:</label>
		<div class="col-sm-10">
			<?php	$sql = $conn->query("SELECT Dev_ID, Barcode FROM IA_Devices"); ?>
			<select  name="Dev_ID">
				<option style="display:none" value="">Kies barcode van computer</option>
			<?php	while ($row = $sql->fetch(PDO::FETCH_ASSOC)) {
						echo '<option value="'.$row['Dev_ID'].'">'.$row['Barcode'].'</option>';
					} ?>
			</select>
		</div>
	</div>
	<a href="insertComForm.php">Computer bestaat nog niet? Voeg hem hier toe</a><br><br>
	<div class="form-group">
		<label class="control-label col-sm-2" for="soft_id">Softwarenaam & versie:</label>
		<div class="col-sm-10">
			<?php	$sql = $conn->query("SELECT Soft_ID, Soft_naam, Versie FROM IA_Software"); ?>
			<select  name="soft_id" required>
				<option style="display:none" value="">Kies het programma</option>
			<?php	while ($row = $sql->fetch(PDO::FETCH_ASSOC)) {
						echo '<option value="'.$row['Soft_ID'].'">'.$row['Soft_naam'].' '.$row['Versie'].'</option>';
					} ?>
			</select>
			<input type='submit' name='submit3' value='Delete' class='btn btn-danger'>
		</div>
	</div>
	<a href="insertNewSoftForm.php">Software bestaat nog niet? Voeg hem hier toe</a><br><br>
	<div class="form-group">
		<label class="control-label col-sm-2" for="soft_a_date">Aanschaf datum:</label>
		<div class="col-sm-10">
			<input type='date' id='picker' name='soft_a_date' placeholder='Aanschaf datum' class='form-control' >
		</div>
	</div>
	<div class="form-group">
		<label class="control-label col-sm-2" for="soft_a_prijs">Aanschaf datum:</label>
		<div class="col-sm-10">
			<input type='text' name='soft_a_prijs' id='money' placeholder='Aanschaf waarde' class='form-control' >
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
	$soft_id = trim($_POST['soft_id']);
	$Dev_ID = trim($_POST['Dev_ID']);
	$soft_a_date = trim($_POST['soft_a_date']);
	$soft_a_prijs = trim($_POST['soft_a_prijs']);

try {
	$stmt = $conn->prepare("INSERT INTO IA_Software_RG (Soft_ID, Dev_ID, Aanschaf_dat, Aanschaf_waarde)
							VALUES (?,?,?,?)");
	$stmt->execute([$soft_id, $Dev_ID, $soft_a_date, $soft_a_prijs]);	
	echo '<meta http-equiv="refresh" content="0;URL=https://portal.basrt.eu/inventadmin/" />';
}catch(PDOException $e){
	//echo $stmt . "<br>" . $e->getMessage();
	echo "<script>alert('Vul de velden goed in!');</script>";
	echo '<meta http-equiv="refresh" content="0;URL=https://portal.basrt.eu/inventadmin/insert/insertSoftForm.php" />';
}
}
if(isset($_POST['submit3'])){
		
		$soft_id = $_POST['soft_id'];
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "DELETE FROM IA_Software WHERE Soft_ID = $soft_id";
			if ($conn->query($sql)) {
				echo '<meta http-equiv="refresh" content="0;URL=https://portal.basrt.eu/inventadmin/" />';
			}
			else{
				echo "Iets gaat er fout";
			}
}
$conn = null;
?>