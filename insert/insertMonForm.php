<html><head><link rel="icon" sizes="32x32" type="image/png" href="../favicon.ico"/><title>Inventadmin</title>
<meta http-equiv="X-UA-Compatible" content="IE=edge;" /><?php
	include "../includes/connection.php";
?><style><?php
	include "../includes/css/styleMon.css";
?></style><script>
<?php include "../includes/js/addMon.js";
	  include "../includes/js/datetime.js";?>
</script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
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
<?php
	echo "<div class='navbar'>";
	echo "<a href='https://portal.basrt.eu/index/login.php'>Portal</a>";
	echo "<a href='../index.php'>Overzicht</a>";
	echo "</div>";		
			echo "<div class='form'>";
			echo "<H4> Voeg Monitor toe</H4>";
				echo "<form method='post' action='insertMon.php'>";
					$sql = $conn->query("SELECT Com_ID, Barcode FROM IA_Computer"); 
					
					echo "<label>Computer barcode</label>";
					echo '<select  name="com_id" required>'; 
					echo '<option style="display:none" value="">Kies barcode van computer</option>';
					while ($row = $sql->fetch(PDO::FETCH_ASSOC)) {
					   echo '<option value="'.$row['Com_ID'].'">'.$row['Barcode'].'</option>';
					}
					echo '</select>';
				// _-_-_-_-_-_-_-_-_-_-_-_-_-_-Monitor-_-_-_-_-_-_-_-_-_-_-_-_-_
				
				?>
			    <INPUT type="button" value="Voeg extra monitor toe" onclick="addRow('dataTable')" />
				<INPUT type="button" value="Verwijder rij" onclick="deleteRow('dataTable')" />
				<?php
				echo "<table id='dataTable'>";
				echo "<tr>";
				echo "<td><input type='checkbox' name='chk'></td>";
				echo "<td><input type='text' name='mon_barcode[]'  placeholder='Barcode' required></td>";
				echo "<td><input type='text' name='mon_merk[]'  placeholder='Merk' required></td>";
				echo "<td><input type='text' name='mon_type[]' placeholder='Type' required></td>";
				echo "<td><input type='number' name='mon_inch[]' placeholder='Inch' required></td>";
				echo "<td><input type='date' id='picker' min='1899-01-01' max='2000-13-13' name='mon_a_date[]' placeholder='Aanschaf datum' required></td>";
				echo "<td><input type='text' id='money' name='mon_a_prijs[]' min='0' placeholder='Aanschaf Waarde' required></td>";
				echo "</tr>";
				echo "</table>";
				
				echo "<input type='submit' name='submit2' value='voeg toe'>";
				echo "</form>";
			echo "</div>";

	
?>