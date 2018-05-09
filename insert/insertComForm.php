<html><head><link rel="icon" sizes="32x32" type="image/png" href="../favicon.ico"/><title>Inventadmin</title>
<meta http-equiv="X-UA-Compatible" content="IE=edge;" /><?php
	include "../includes/connection.php";
	include "../includes/scripts.php";
?>
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


<H4> Voeg Computer toe</H4>
<form id='com_form' action='insertComForm.php' method='post' class="form-group">
	<div class="form-group">
		<label class="control-label col-sm-2" for="com_barcode">Computer barcode:</label>
		<div class="col-sm-10">
			<input type='text' name='com_barcode'   placeholder='Barcode' class='form-control' required>
		</div>
	</div>
	<div class="form-group">
		<label class="control-label col-sm-2" for="com_naam">Computernaam:</label>
		<div class="col-sm-10">
			<input type='text' name='com_naam'  placeholder='Computernaam' class='form-control' required>
		</div>
	</div>
	<div class="form-group">
		<label class="control-label col-sm-2" for="com_ip">Ip-adres:</label>
		<div class="col-sm-10">
			<input type='text' name='com_ip' placeholder='Ip-adres' class='form-control' required>
		</div>
	</div>
	<div class="form-group">
		<label class="control-label col-sm-2" for="com_merk">Merk:</label>
		<div class="col-sm-10">
			<input type='text' name='com_merk' placeholder='Merk' class='form-control' required>
		</div>
	</div>
	<div class="form-group">
		<label class="control-label col-sm-2" for="com_cpu">Processor:</label>
		<div class="col-sm-10">
			<input type='text' name='com_cpu'  placeholder='CPU' class='form-control' required>
		</div>
	</div>
	<div class="form-group">
		<label class="control-label col-sm-2" for="com_ram">Ram geheugen:</label>
		<div class="col-sm-10">
			<input type='text' name='com_ram'  placeholder='RAM' class='form-control' required>
		</div>
	</div>
	<div class="form-group">
		<label class="control-label col-sm-2" for="com_moed">Moederbord:</label>
		<div class="col-sm-10">
			<input type='text' name='com_moed' placeholder='Moederbord' class='form-control' required>
		</div>
	</div>
	<div class="form-group">
		<label class="control-label col-sm-2" for="com_serial">Serialnummer:</label>
		<div class="col-sm-10">
			<input type='text' name='com_serial' placeholder='Serialnummer' class='form-control' required>
		</div>
	</div>
	<div class="form-group">
		<label class="control-label col-sm-2" for="com_a_date">Aanschaf datum:</label>
		<div class="col-sm-10">
			<input type='date' id='picker' name='com_a_date' placeholder='Aanschaf datum' class='form-control' required>
		</div>
	</div>
	<div class="form-group">
		<label class="control-label col-sm-2" for="com_a_prijs">Aanschaf waarde:</label>
		<div class="col-sm-10">
			<input type='text' name='com_a_prijs' placeholder='Aanschaf waarde' class='form-control' required>
		</div>
	</div>
	<div class="form-group">
		<label class="control-label col-sm-2" for="comment">Opmerkingen:</label>
		<div class="col-sm-10">
			<textarea class="form-control" rows="5" name='comment' placeholder='Opmerkingen'></textarea>
		</div>
	</div>
		<input type='submit' name='submit2' class='btn btn-success' value='voeg toe'>
</form>

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
$com_moed = $_POST['com_moed'];
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
	$stmt = $conn->prepare("INSERT INTO IA_Computer (Barcode, Com_naam, Ip_adres, Com_merk, CPU_naam, Memory, Moederbord, Serialnummer, Aanschaf_dat, Aanschaf_waarde, Opmerkingen)
							VALUES (?,?,?,?,?,?,?,?,?,?,?)");
	$stmt->execute([$com_barcode, $com_naam, $com_ip, $com_merk, $com_cpu, $com_ram, $com_moed, $com_serial, $com_a_date, $com_a_prijs, $comment]);
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