<html><head><link rel="icon" sizes="32x32" type="image/png" href="../favicon.ico"/><title>Inventadmin</title>
<meta http-equiv="X-UA-Compatible" content="IE=edge;" /><?php
error_reporting(E_ALL); ini_set('display_errors', 1);
	include "../includes/connection.php";
?><style><?php
	include "../includes/css/style.css";
?></style><script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
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
<div class='navbar'>
	<a href='http://webserver03/index/login.php'>Portal</a>
	<a href='../index.php'>Overzicht</a>
</div>

<?php
	$id = $_GET['edit'];
	
	$sql = "SELECT * FROM IA_Computer WHERE Com_ID=:id";
	$query = $conn->prepare($sql);
	$query->execute(array(':id' => $id));

	while($row = $query->fetch(PDO::FETCH_ASSOC))
	{
    $barcode = $row['Barcode'];
	$naam = $row['Com_naam'];
    $ip = $row['Ip_adres'];
    $merk = $row['Com_merk'];
    $cpu = $row['CPU_naam'];
    $mem = $row['Memory'];
    $serial = $row['Serialnum'];
    $datum = $row['Aanschaf_dat'];
    $waarde = $row['Aanschaf_waarde'];
	
	$newDate = date("Y-m-d", strtotime($datum));
	}
	
	
?> 
<body>
	<div class="form">
		<H4>Computer</H4>
		<form name="form1" method="post" action="updateCom.php">
		<label>Barcode</label>
			<input type="text" name="barcode"   value="<?php echo $barcode;?>">
		<label>Computernaam</label>
			<input type="text" name="naam" value="<?php echo $naam;?>">
		<label>Ip-adres</label>
			<input type="text" name="ip"  value="<?php echo $ip;?>">
		<label>Merk</label>
			<input type="text" name="merk" value="<?php echo $merk;?>">
		<label>Processor</label>
			<input type="text" name="cpu" value="<?php echo $cpu;?>">
		<label>RAM-Memory</label>	
			<input type="text" name="mem" value="<?php echo $mem;?>">
		<label>Moederbord</label>
			<input type="text" name="serial" value="<?php echo $serial;?>">
		<label>Aanschaf datum</label>
			<input type="date" id="picker" name="date" value="<?php echo $newDate;?>">
		<label>Aanschaf waarde</label>
			<input type="text" name="waarde" value="<?php echo $waarde;?>">
			<input type="hidden" name="id" value="<?php echo $_GET['edit'];?>">
			<input type="submit" name="update" value="Update">
		</form>
	</div>
</body>