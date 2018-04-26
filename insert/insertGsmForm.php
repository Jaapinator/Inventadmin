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
	<H4>Telefoon</H4>
	<form method="post" action="insertGsm.php" id="gsm_form">
	<?php
	$sql = $conn->query("SELECT U_ID, Gebruiker FROM IA_Gebruiker"); 
					
					echo "<label>Gebruiker</label>";
					echo '<select  name="user" required>'; 
					echo '<option style="display:none" value="">Kies gebruiker van de telefoon</option>';
					while ($row = $sql->fetch(PDO::FETCH_ASSOC)) {
					   echo '<option value="'.$row['U_ID'].'">'.$row['Gebruiker'].'</option>';
					}
					echo '</select>';
					?>
	<label>Telefoonnummer</label>
	<input type="text" name="nummer" placeholder="Telefoonnummer" required>
	<label>Merk</label>
	<input type="text" name="merk" placeholder="Merk" required>
	<label>Model</label>
	<input type="text" name="model" placeholder="Model" required>
	<label>Aanschaf datum</label>
	<input type="date" id="picker" name="datum" required>
	<label>Aanschaf waarde</label>
	<input type="text" name="prijs" placeholder="Aanschaf waarde" required>
	<label>Foto telefoon</label>
	<br>
	<input type="file" name="uploadFile">
	<input type="submit" name="submit" value="Voeg toe">
	</form>
	</div>