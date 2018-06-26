<html><head><link rel="icon" sizes="32x32" type="image/png" href="../favicon.ico"/><title>Inventadmin</title>
<meta http-equiv="X-UA-Compatible" content="IE=edge;" /><?php
error_reporting(E_ALL); ini_set('display_errors', 1);
	include "../includes/connection.php";
	include "../includes/scripts.php";
?>
<script><?php 
include "../includes/js/addMon.js";
include "../includes/js/maxtime.js" ?>
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
	<H4> Voeg een nieuw programma toe</H4>
	<hr>
	<form id='soft_form' action='insertSoftForm.php' method='post'>
	<?php $sql = $conn->query("SELECT Dev_ID, Barcode FROM IA_Devices"); ?>
		<label>Computer barcode: </label>
			<select  name="Dev_ID">'; 
				<option style="display:none" value="">Kies barcode van computer</option>
			<?php	while ($row = $sql->fetch(PDO::FETCH_ASSOC)) {
					   echo '<option value="'.$row['Dev_ID'].'">'.$row['Barcode'].'</option>';
					} ?>
			</select>
		<br>
			    <input type="button" value="Voeg extra monitor toe" class='btn btn-warning' onclick="addRow('dataTable')" />
				<input type="button" value="Verwijder rij" class='btn btn-danger' onclick="deleteRow('dataTable')" />
		<a href="insertNewSoftForm.php" class="btn btn-success">Voeg nieuwe software toe</a><br>
			<table id='dataTable'>
				<tr>
				<td><input type='checkbox' name='chk'></td>
				<td><?php	$sql = $conn->query("SELECT Soft_ID, Soft_naam, Versie FROM IA_Software"); ?>
					<select  name="soft_id[]" required>
						<option style="display:none" value="">Kies het programma</option>
					<?php	while ($row = $sql->fetch(PDO::FETCH_ASSOC)) {
								echo '<option value="'.$row['Soft_ID'].'">'.$row['Soft_naam'].' '.$row['Versie'].'</option>';
							} ?>
					</select>
				</td>
				<td><input type='date' id='picker' min='1899-01-01' max='2000-13-13' class='form-control' name='soft_a_date[]' placeholder='Aanschaf datum' required></td>
				<td><input type='text' id='money' name='soft_a_prijs[]' min='0' class='form-control' placeholder='Aanschaf Waarde' required></td>
				</tr>
			</table>
		<input type='submit' name='submit4' value='Voeg toe' class='btn btn-success'>
	</form>
</div>
</div>
</body>
</html>
<?php
if(isset($_POST['submit4'])){
	$soft_id = trim($_POST['soft_id']);
	$Dev_ID = trim($_POST['Dev_ID']);
	$soft_a_date = trim($_POST['soft_a_date']);
	$soft_a_prijs = trim($_POST['soft_a_prijs']);

try {
	$stmt = $conn->prepare("INSERT INTO IA_Software_RG (Soft_ID, Dev_ID, Aanschaf_dat, Aanschaf_waarde)
							VALUES (?,?,?,?)");
	foreach ($Dev_ID as $i => $dev) {
		$stmt->execute([$soft_id[$i], $dev, $soft_a_date[$i], $soft_a_prijs[$i]]);	
		echo '<meta http-equiv="refresh" content="0;URL=https://portal.basrt.eu/inventadmin/" />';
	}
}catch(PDOException $e){
	//echo $stmt . "<br>" . $e->getMessage();
	echo "<script>alert('Vul de velden goed in!');</script>";
	echo '<meta http-equiv="refresh" content="0;URL=https://portal.basrt.eu/inventadmin/insert/insertSoftForm.php" />';
}
}
/*if(isset($_POST['submit3'])){
		
		$soft_id = $_POST['soft_id'];
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "DELETE FROM IA_Software WHERE Soft_ID = $soft_id";
			if ($conn->query($sql)) {
				echo '<meta http-equiv="refresh" content="0;URL=https://portal.basrt.eu/inventadmin/" />';
			}
			else{
				echo "Iets gaat er fout";
			}
}*/
$conn = null;
?>