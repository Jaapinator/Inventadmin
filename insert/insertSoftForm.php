<html><head><link rel="icon" sizes="32x32" type="image/png" href="../favicon.ico"/><title>Inventadmin</title>
<meta http-equiv="X-UA-Compatible" content="IE=edge;" /><?php
	include "../includes/connection.php";
?><style><?php
	include "../includes/css/style.css";
?></style><script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.13/jquery.mask.min.js"></script><script>
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
</script><?php

	echo "<div class='navbar'>";
	echo "<a href='http://webserver03/index/login.php'>Portal</a>";
	echo "<a href='../index.php'>Overzicht</a>";
	echo "</div>";
			echo "<div class='form'>";
			echo "<H4> Voeg een nieuw programma toe</H4>";
				echo "<form id='soft_form' action='insertSoft.php' method='post'>";
				$sql = $conn->query("SELECT Com_ID, Barcode FROM IA_Computer"); 
					echo "<label>Computer barcode</label>";
					echo '<select  name="com_id" required>';
					echo '<option style="display:none" value="" ">Kies barcode van computer</option>';
					while ($row = $sql->fetch(PDO::FETCH_ASSOC)) {
					   echo '<option value="'.$row['Com_ID'].'">'.$row['Barcode'].'</option>';
					}
					echo '</select>';
					echo '<a href="insertComForm.php">Computer bestaat nog niet? Voeg hem hier toe</a><br><br>';
				$sql = $conn->query("SELECT Soft_ID, Soft_naam, Versie FROM IA_Software"); 
					echo "<label>Softwarenaam & versie</label>";
					echo '<select  name="soft_id" required>';
					echo '<option style="display:none" value="" ">Kies het programma</option>';
					while ($row = $sql->fetch(PDO::FETCH_ASSOC)) {
					   echo '<option value="'.$row['Soft_ID'].'">'.$row['Soft_naam'].' '.$row['Versie'].'</option>';
					}
					echo '</select>';
					echo '<a href="insertNewSoftForm.php">Software bestaat nog niet? Voeg hem hier toe</a><br><br>';
				echo "<label>Aanschaf datum</label>";
				echo "<input type='date' id='picker' name='soft_a_date' placeholder='Aanschaf datum' required>";
				echo "<label>Aanschaf waarde</label>";
				echo "<input type='text' name='soft_a_prijs' id='money' placeholder='Aanschaf waarde' required>";
				echo "<input type='submit' name='submit4' value='voeg toe'>";
				echo "</form>";
			echo "</div>";
			
?>