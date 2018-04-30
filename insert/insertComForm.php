<html><head><link rel="icon" sizes="32x32" type="image/png" href="../favicon.ico"/><title>Inventadmin</title>
<meta http-equiv="X-UA-Compatible" content="IE=edge;" /><?php
	include "../includes/connection.php";
?><style><?php
	include "../includes/css/style.css";
?></style><script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="../includes/js/modernizr-custom.js"></script>
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
			echo "<div class='form'>";
				// _-_-_-_-_-_-_-_-_-_-_-_-_-_-Computer-_-_-_-_-_-_-_-_-_-_-_-_-_
				echo "<H4> Voeg Computer toe</H4>";
				echo "<form id='com_form' action='insertCom.php' method='post'>";
				echo "<label>Computer barcode</label>";
				echo "<input type='text' name='com_barcode'   placeholder='Barcode' required>";	
				echo "<label>Computernaam</label>";
				echo "<input type='text' name='com_naam'  placeholder='Computernaam' onpaste='return false'>";	
				echo "<label>Ip-adres</label>";	
				echo "<input type='text' class='ip_address' id='ip_address'  name='com_ip' placeholder='Ip-adres' required>";	
				echo "<label>Merk</label>";
				echo "<input type='text' name='com_merk'  placeholder='Merk' onpaste='return false' required>";	
				echo "<label>Processor</label>";
				echo "<input type='text' name='com_cpu'  placeholder='CPU' required>";
				echo "<label>Ram geheugen</label>";
				echo "<input type='text' name='com_ram'  placeholder='RAM' required>";
				echo "<label>Moederbord</label>";	
				echo "<input type='text' name='com_serial' placeholder='Moederbord' required>";
				echo "<label>Aanschaf datum</label>";
				echo "<input type='date' id='picker' name='com_a_date' placeholder='Aanschaf datum' required>";
				echo "<label>Aanschaf waarde</label>";
				echo "<input type='text' class='money' id='money' name='com_a_prijs' placeholder='Aanschaf waarde' required>";
				echo "<label>Opmerkingen</label><br>";
				echo "<textarea name='comment' placeholder='Opmerkingen'></textarea><br>";
				echo "<input type='submit' name='submit2' value='voeg toe'>";
				echo "</form>";
			echo "</div>";

	
?>
</body></html>