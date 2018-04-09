<html><head><link rel="icon" sizes="32x32" type="image/png" href="../favicon.ico"/><title>Inventadmin</title>
<meta http-equiv="X-UA-Compatible" content="IE=edge;" /><style><?php
	include "../includes/css/style.css";
?></style><?php
	include "../includes/connection.php";
?><script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
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
</script></head><body><?php
	echo "<div class='navbar'>";
	echo "<a href='https://portal.basrt.eu/index/login.php'>Portal</a>";
	echo "<a href='../index.php'>Overzicht</a>";
	echo "</div>";
	?>
	<div class='form'>
	<H4>Randapparatuur</H4>
	<form method="post" action="insertRand.php" id="rand_form">
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