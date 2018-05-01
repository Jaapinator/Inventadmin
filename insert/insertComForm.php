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
</script>
</head>
<body>
<div class='navbar'>
	<a href='https://portal.basrt.eu/index/login.php'>Portal</a>
	<a href='../index.php'>Overzicht</a>
</div>
<div class='form'>
	<H4> Voeg Computer toe</H4>
	<form id='com_form' action='insertComForm.php' method='post'>
	<label>Computer barcode</label>
		<input type='text' name='com_barcode'   placeholder='Barcode' required>
	<label>Computernaam</label>
		<input type='text' name='com_naam'  placeholder='Computernaam'>
	<label>Ip-adres</label>
		<input type='text' class='ip_address' id='ip_address'  name='com_ip' placeholder='Ip-adres' required>	
	<label>Merk</label>
		<input type='text' name='com_merk'  placeholder='Merk' required>	
	<label>Processor</label>
		<input type='text' name='com_cpu'  placeholder='CPU' required>
	<label>Ram geheugen</label>
		<input type='text' name='com_ram'  placeholder='RAM' required>
	<label>Moederbord</label>
		<input type='text' name='com_serial' placeholder='Moederbord' required>
	<label>Aanschaf datum</label>
		<input type='date' id='picker' name='com_a_date' placeholder='Aanschaf datum' required>
	<label>Aanschaf waarde</label>
		<input type='text' class='money' id='money' name='com_a_prijs' placeholder='Aanschaf waarde' required>
	<label>Opmerkingen</label><br>
		<textarea name='comment' placeholder='Opmerkingen'></textarea><br>
		<input type='submit' name='submit2' value='voeg toe'>
	</form>
</div>
</body>
</html>
<?php
if(isset($_POST['submit2'])){
$com_barcode = $_POST['com_barcode'];
$com_naam = $_POST['com_naam'];
$com_ip = $_POST['com_ip'];
$com_merk = $_POST['com_merk'];
$com_cpu = $_POST['com_cpu'];
$com_ram = $_POST['com_ram'];
$com_serial = $_POST['com_serial'];
$com_a_date = $_POST['com_a_date'];
$com_a_prijs = $_POST['com_a_prijs'];
$comment = $_POST['comment'];

$result = $conn->prepare("SELECT count(*) FROM IA_Computer WHERE Ip_adres=:ip"); 
$result->bindParam(':ip', $com_ip, PDO::PARAM_STR);
$result->execute();
$rowCount = $result->fetchColumn(0);

if($rowCount == 0){
try{
	$stmt = $conn->prepare("INSERT INTO IA_Computer (Barcode, Com_naam, Ip_adres, Com_merk, CPU_naam, Memory, Serialnum, Aanschaf_dat, Aanschaf_waarde, Opmerkingen)
							VALUES (?,?,?,?,?,?,?,?,?,?)");
	$stmt->execute([$com_barcode, $com_naam, $com_ip, $com_merk, $com_cpu, $com_ram, $com_serial, $com_a_date, $com_a_prijs, $comment]);
	echo '<meta http-equiv="refresh" content="0;URL=https://portal.basrt.eu/inventadmin/" />';
}
catch(PDOException $e){
	echo $stmt . "<br>" . $e->getMessage();
	echo '<meta http-equiv="refresh" content="0;URL=https://portal.basrt.eu/inventadmin/insert/insertComForm.php" />';

}
}
else{
	echo "<script> alert('Ip-adres bestaat al');</script>";
	echo '<meta http-equiv="refresh" content="0;URL=https://portal.basrt.eu/inventadmin/insert/insertComForm.php" />';
}
}
$conn = null;
?>