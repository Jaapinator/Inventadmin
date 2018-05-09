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
	<H4> Voeg een nieuw programma toe</H4>
	<form id='soft_form' action='insertSoftForm.php' method='post'>
	<?php	$sql = $conn->query("SELECT Com_ID, Barcode FROM IA_Computer"); ?>
	<label>Computer barcode</label>
		<select  name="com_id" required>
			<option style="display:none" value="">Kies barcode van computer</option>
		<?php	while ($row = $sql->fetch(PDO::FETCH_ASSOC)) {
					echo '<option value="'.$row['Com_ID'].'">'.$row['Barcode'].'</option>';
				} ?>
		</select>
		<a href="insertComForm.php">Computer bestaat nog niet? Voeg hem hier toe</a><br><br>
	<?php	$sql = $conn->query("SELECT Soft_ID, Soft_naam, Versie FROM IA_Software"); ?>
	<label>Softwarenaam & versie</label>
		<select  name="soft_id" required>
			<option style="display:none" value="">Kies het programma</option>
		<?php	while ($row = $sql->fetch(PDO::FETCH_ASSOC)) {
					echo '<option value="'.$row['Soft_ID'].'">'.$row['Soft_naam'].' '.$row['Versie'].'</option>';
				} ?>
		</select>
		<a href="insertNewSoftForm.php">Software bestaat nog niet? Voeg hem hier toe</a><br><br>
	<label>Aanschaf datum</label>
		<input type='date' id='picker' name='soft_a_date' placeholder='Aanschaf datum' required>
	<label>Aanschaf waarde</label>
		<input type='text' name='soft_a_prijs' id='money' placeholder='Aanschaf waarde' required>
		<input type='submit' name='submit4' value='voeg toe'>
	</form>
</div>
</body>
</html>
<?php
if(isset($_POST['submit4'])){
	$soft_id = trim($_POST['soft_id']);
	$com_id = trim($_POST['com_id']);
	$soft_a_date = trim($_POST['soft_a_date']);
	$soft_a_prijs = trim($_POST['soft_a_prijs']);

try {
	$stmt = $conn->prepare("INSERT INTO IA_Software_RG (Soft_ID, Com_ID, Aanschaf_dat, Aanschaf_waarde)
							VALUES (?,?,?,?)");
	$stmt->execute([$soft_id, $com_id, $soft_a_date, $soft_a_prijs]);	
	echo '<meta http-equiv="refresh" content="0;URL=https://portal.basrt.eu/inventadmin/" />';
}catch(PDOException $e){
	//echo $stmt . "<br>" . $e->getMessage();
	echo "<script>alert('Vul de velden goed in!');</script>";
	echo '<meta http-equiv="refresh" content="0;URL=https://portal.basrt.eu/inventadmin/insert/insertSoftForm.php" />';
}
}
$conn = null;
?>