<html><head><link rel="icon" sizes="32x32" type="image/png" href="../favicon.ico"/><title>Inventadmin</title>
<meta http-equiv="X-UA-Compatible" content="IE=edge;" />
<?php
	include "../includes/connection.php";
	include "../includes/scripts.php";
?>
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
</script></head><body>
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
	<H4>Randapparatuur</H4>
	<form method="post" action="insertRandForm.php" id="rand_form">
	<?php
	$sql = $conn->query("SELECT Com_ID, Barcode FROM IA_Computer"); 
					
					echo "<label>Computer barcode</label>";
					echo '<select  name="com_id" required>'; 
					echo '<option style="display:none" value="">Kies barcode van computer</option>';
					while ($row = $sql->fetch(PDO::FETCH_ASSOC)) {
					   echo '<option value="'.$row['Com_ID'].'">'.$row['Barcode'].'</option>';
					}
					echo '</select>';
					?>
	<label>Merk</label>
		<input type="text" name="rand_merk" placeholder="Merk" required>
	<label>Type</label>
		<input type="text" name="rand_type" placeholder="Type" required>
	<label>Aanschaf datum</label>
		<input type="date" id="picker" name="datum" required>
	<label>Aanschaf waarde</label>
		<input type="text" name="prijs" placeholder="Aanschaf waarde" required>
		<input type="submit" name="submit" value="Voeg toe">
	</form>
</div>
</body>
</html>
<?php
if(isset($_POST['submit'])){
$comid = $_POST['com_id'];
$rand_merk = $_POST['rand_merk'];
$rand_type = $_POST['rand_type'];
$date = $_POST['datum'];
$waarde = $_POST['prijs'];


try{
	$stmt = $conn->prepare("INSERT INTO IA_Randapparatuur (Com_ID, Merk, Type, Aanschaf_dat, Aanschaf_waarde)
							VALUES (?,?,?,?,?)");
	$stmt->execute([$comid, $rand_merk, $rand_type, $date, $waarde]);
	echo '<meta http-equiv="refresh" content="0;URL=https://portal.basrt.eu/inventadmin/" />';
}
catch(PDOException $e){
	echo $stmt . "<br>" . $e->getMEssage();
	echo '<meta http-equiv="refresh" content="0;URL=https://portal.basrt.eu/inventadmin/insert/insertRandForm.php" />';
}
}
$conn = null;
?>