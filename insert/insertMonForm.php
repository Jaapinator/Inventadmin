<html><head><link rel="icon" sizes="32x32" type="image/png" href="../favicon.ico"/><title>Inventadmin</title>
<meta http-equiv="X-UA-Compatible" content="IE=edge;" /><?php
error_reporting(E_ALL); ini_set('display_errors', 1);
	include "../includes/connection.php";
	include "../includes/scripts.php";
?><script>
<?php include "../includes/js/addMon.js";
	  include "../includes/js/datetime.js";?>
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
<div class="container">
	<div class="main-login main-center">
	<H4> Voeg Monitor toe</H4>
	<hr>
	<form method='post' action='insertMonForm.php'>
		<?php $sql = $conn->query("SELECT Dev_ID, Barcode FROM IA_Devices"); ?>
		<label>Computer barcode: </label>
			<select  name="Dev_ID">'; 
				<option style="display:none" value="">Kies barcode van computer</option>
			<?php	while ($row = $sql->fetch(PDO::FETCH_ASSOC)) {
					   echo '<option value="'.$row['Dev_ID'].'">'.$row['Barcode'].'</option>';
					} ?>
			</select>
		
			    <input type="button" value="Voeg extra monitor toe" class='btn btn-warning' onclick="addRow('dataTable')" />
				<input type="button" value="Verwijder rij" class='btn btn-danger' onclick="deleteRow('dataTable')" />
			<table id='dataTable'>
				<tr>
				<td><input type='checkbox' name='chk'></td>
				<td><input type='text' name='mon_barcode[]'  placeholder='Barcode' class='form-control' required></td>
				<td><input type='text' name='mon_merk[]'  placeholder='Merk' class='form-control' required></td>
				<td><input type='text' name='mon_type[]' placeholder='Type' class='form-control' required></td>
				<td><input type='number' name='mon_inch[]' placeholder='Inch' class='form-control' required></td>
				<td><input type='date' id='picker' min='1899-01-01' max='2000-13-13' class='form-control' name='mon_a_date[]' placeholder='Aanschaf datum' required></td>
				<td><input type='text' id='money' name='mon_a_prijs[]' min='0' class='form-control' placeholder='Aanschaf Waarde' required></td>
				</tr>
			</table>
		<input type='submit' name='submit2' value='Voeg toe' class='btn btn-success'>
	</form>
</div>
</div>
</body>
</html>
<?php
if(isset($_POST['submit2'])){
    //id
    $Dev_ID = $_POST['Dev_ID'];
    //array
    $mon_barcode = $_POST['mon_barcode'];
    $mon_merk = $_POST['mon_merk'];
    $mon_type = $_POST['mon_type'];
    $mon_inch = $_POST['mon_inch'];
    $mon_a_date = $_POST['mon_a_date'];
    $mon_a_prijs = $_POST['mon_a_prijs'];
	
	if($Dev_ID == 0){
		$sql = "INSERT INTO IA_Monitor (Dev_ID, Barcode, Merk, Type, Inch, Aanschaf_dat, Aanschaf_waarde) VALUES (?,?,?,?,?,?,?)";
		try {
			$stmt = $conn->prepare($sql);
			foreach ($mon_barcode as $i => $barcode) {
				$stmt->execute([NULL, $barcode, $mon_merk[$i], $mon_type[$i], $mon_inch[$i], $mon_a_date[$i], $mon_a_prijs[$i]]);
				echo '<meta http-equiv="refresh" content="0;URL=https://portal.basrt.eu/inventadmin/" />';
			}
		} catch (\PDOException $e) {
		//    echo $sql . "<br>" . $e->getMessage();
		echo "<script>alert('Vul de velden goed in!');</script>";
		echo '<meta http-equiv="refresh" content="0;URL=https://portal.basrt.eu/inventadmin/insert/insertMonForm.php" />';
		}
	}else{
		$sql = "INSERT INTO IA_Monitor (Dev_ID, Barcode, Merk, Type, Inch, Aanschaf_dat, Aanschaf_waarde) VALUES (?,?,?,?,?,?,?)";
		try {
			$stmt = $conn->prepare($sql);
			foreach ($mon_barcode as $i => $barcode) {
				$stmt->execute([$Dev_ID, $barcode, $mon_merk[$i], $mon_type[$i], $mon_inch[$i], $mon_a_date[$i], $mon_a_prijs[$i]]);
				echo '<meta http-equiv="refresh" content="0;URL=https://portal.basrt.eu/inventadmin/" />';
			}
		} catch (\PDOException $e) {
		//    echo $sql . "<br>" . $e->getMessage();
		echo "<script>alert('Vul de velden goed in!');</script>";
		echo '<meta http-equiv="refresh" content="0;URL=https://portal.basrt.eu/inventadmin/insert/insertMonForm.php" />';
		}
	}
$conn = null;
}
?>