<html><head><link rel="icon" sizes="32x32" type="image/png" href="../favicon.ico"/><title>Inventadmin</title>
<meta http-equiv="X-UA-Compatible" content="IE=edge;" /><?php
error_reporting(E_ALL); ini_set('display_errors', 1);
	include "../includes/connection.php";
	include "../includes/scripts.php";?>
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

<?php
	$id = $_GET['edit'];
	
	$sql = "SELECT * FROM IA_Devices WHERE Dev_ID=:id";
	$query = $conn->prepare($sql);
	$query->execute(array(':id' => $id));

	while($row = $query->fetch(PDO::FETCH_ASSOC))
	{
    $barcode = $row['Barcode'];
	$naam = $row['Naam'];
    $ip = $row['Ip_adres'];
    $merk = $row['Merk'];
    $model = $row['Model'];
    $cpu = $row['CPU'];
    $mem = $row['Memory'];
    $moed = $row['Moederbord'];
    $serial = $row['Serialnummer'];
    $datum = $row['Aanschaf_dat'];
    $waarde = $row['Aanschaf_waarde'];
	
	$newDate = date("Y-m-d", strtotime($datum));
	}
	
	
?> 
<body>
	<div class="form">
		<H4>Computer</H4>
		<form name="form1" method="post" action="editCom.php?edit= <?php $id; ?>">
		<label>Barcode</label>
			<input type="text" name="barcode"   value="<?php echo $barcode;?>">
		<label>Computernaam</label>
			<input type="text" name="naam" value="<?php echo $naam;?>">
		<label>Ip-adres</label>
			<input type="text" name="ip"  value="<?php echo $ip;?>">
		<label>Merk</label>
			<input type="text" name="merk" value="<?php echo $merk;?>">
		<label>Model</label>
			<input type="text" name="model" value="<?php echo $model;?>">
		<label>Processor</label>
			<input type="text" name="cpu" value="<?php echo $cpu;?>">
		<label>RAM-Memory</label>	
			<input type="text" name="mem" value="<?php echo $mem;?>">
		<label>Moederbord</label>
			<input type="text" name="moed" value="<?php echo $moed;?>">
		<label>Serialnummer</label>
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
</html>
<?php
if(isset($_POST['update']))
{    
    $id = $_POST['id'];
    
    $barcode = trim($_POST['barcode']);
	$naam = trim($_POST['naam']);
    $merk = trim($_POST['merk']);
    $model = trim($_POST['model']);
    $ip = trim($_POST['ip']);    
    $cpu = trim($_POST['cpu']);    
    $mem = trim($_POST['mem']);    
    $moed = trim($_POST['moed']);    
    $serial = trim($_POST['serial']);    
    $datum = trim($_POST['date']);    
    $waarde = trim($_POST['waarde']);    
	
    if(empty($barcode) || empty($merk) || /*empty($model) ||*/ empty($naam) || empty($ip) || empty($cpu) || empty($mem) || empty($moed) ||/* empty($serial) || */empty($datum) || empty($waarde)) {    
            
        if(empty($barcode)) {
            echo "<font color='red'>Barcode niet ingevuld.</font><br/>";
        }
		if(empty($naam)) {
            echo "<font color='red'>Computer naam niet ingevuld.</font><br/>";
        }
        if(empty($merk)) {
            echo "<font color='red'>Computer merk niet ingevuld.</font><br/>";
        }
        /*if(empty($model)) {
            echo "<font color='red'>Model niet ingevuld.</font><br/>";
        }*/
        if(empty($ip)) {
            echo "<font color='red'>Ip-adres niet ingevuld.</font><br/>";
        }      
		if(empty($cpu)) {
            echo "<font color='red'>CPU niet ingevuld.</font><br/>";
        } 
		if(empty($mem)) {
            echo "<font color='red'>Ram niet ingevuld.</font><br/>";
        } 
		if(empty($moed)) {
            echo "<font color='red'>Moederbord niet ingevuld.</font><br/>";
        } 
		/*if(empty($serial)) {
            echo "<font color='red'>Serialnummer niet ingevuld.</font><br/>";
        } */
		if(empty($datum)) {
            echo "<font color='red'>Aanschaf datum niet ingevuld.</font><br/>";
        } 
		if(empty($waarde)) {
            echo "<font color='red'>Aanschaf waarde niet ingevuld.</font><br/>";
        } 
    } else {    
        //updating the table
        $sql = "UPDATE IA_Devices
					SET Barcode = :barcode,
						Naam = :naam,
						Ip_adres = :ip, 
						Merk = :merk, 
						Model = :model, 
						CPU = :cpu, 
						Memory = :mem,  
						Moederbord = :moed, 
						Serialnummer = :serial, 
						Aanschaf_dat = :datum, 
						Aanschaf_waarde = :waarde 
				  WHERE Dev_ID = :id";
				 
		$query = $conn->prepare($sql);
		$query->bindparam(":barcode", $barcode);
		$query->bindparam(':naam', $naam);
		$query->bindparam(':ip', $ip);
		$query->bindparam(':merk', $merk);
		$query->bindparam(':model', $model);
		$query->bindparam(':cpu', $cpu);
		$query->bindparam(':mem', $mem);
		$query->bindparam(':moed', $moed);
		$query->bindparam(':serial', $serial);
		$query->bindparam(':datum', $datum);
		$query->bindparam(':waarde', $waarde);
		$query->bindparam(':id', $id);
		$query->execute();
		
		$conn = null;
		
		echo '<meta http-equiv="refresh" content="0;URL=https://portal.basrt.eu/inventadmin/" />';
		} 
}
?>