<html><head><link rel="icon" sizes="32x32" type="image/png" href="../favicon.ico"/><title>Inventadmin</title>
<meta http-equiv="X-UA-Compatible" content="IE=edge;" /><?php
error_reporting(E_ALL); ini_set('display_errors', 1);
	include "../includes/connection.php";
	include "../includes/scripts.php";?>
<script><?php include "../includes/js/maxtime.js" ?>
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
	
	$sql = "SELECT IA_Devices.Barcode, IA_Randapparatuur.Dev_ID, Merk, Type, IA_Randapparatuur.Aanschaf_dat, IA_Randapparatuur.Aanschaf_waarde FROM IA_Randapparatuur, IA_Devices WHERE Rand_ID=:id AND IA_Devices.Dev_ID=IA_Randapparatuur.Dev_ID";
	$query = $conn->prepare($sql);
	$query->execute(array(':id' => $id));

	while($row = $query->fetch(PDO::FETCH_ASSOC))
	{
	$barcode = $row['Barcode'];
	$Dev_ID = $row['Dev_ID'];
    $merk = $row['Merk'];
    $type = $row['Type'];
    $datum = $row['Aanschaf_dat'];
    $waarde = $row['Aanschaf_waarde'];
	
	$newDate = date("Y-m-d", strtotime($datum));
	}
?> 
<body>
<div class="container">
	<div class="main-login main-center">
		<H4>Randapparatuur</H4>
		<hr>
			<form name="form1" method="post" action="editRand.php?edit=<?php $id; ?>">
		<div class="form-group">
		<label class="control-label col-sm-2" for="Dev_ID">Computer barcode:</label>
			<div class="col-sm-10">
			<?php $sql = $conn->query("SELECT Barcode, Dev_ID FROM IA_Devices WHERE Barcode<>$barcode"); ?>
			
					<select  name="Dev_ID" required>
					<option value="<?php echo $Dev_ID; ?>" selected><?php echo $barcode ?></option><?php
					while ($row = $sql->fetch(PDO::FETCH_ASSOC)) {
					   echo '<option value="'.$row['Dev_ID'].'">'.$row['Barcode'].'</option>';
					}?>
					</select>
			</div>
		</div>
		<div class="form-group">
			<label class="control-label col-sm-2" for="merk">Merk:</label>
			<div class="col-sm-10">
				<input type="text" name="merk" value="<?php echo $merk;?>">
			</div>
		</div>
		<div class="form-group">
			<label class="control-label col-sm-2" for="type">Type:</label>
			<div class="col-sm-10">
				<input type="text" name="type" value="<?php echo $type;?>">
			</div>
		</div>
		<div class="form-group">
			<label class="control-label col-sm-2" for="date">Aanschaf datum:</label>
			<div class="col-sm-10">
				<input type='date' id="picker" name='date' value='<?php echo $newDate;?>' class='form-control' required>
			</div>
		</div>
		<div class="form-group">
			<label class="control-label col-sm-2" for="waarde">Aanschaf waarde:</label>
			<div class="col-sm-10">
				<input type='text' name='waarde' value='<?php echo number_format((float)$waarde, 2, '.', '');;?>' class='form-control' required>
			</div>
		</div>
			<input type="hidden" name="id" value="<?php echo $_GET['edit'];?>">
			<input type="submit" name="update" value="Update" class='btn btn-success'>
		</form>
	</div>
</div>
</body>
</html>
<?php 
if(isset($_POST['update']))
{    
    $id = $_POST['id'];
    
	$Dev_ID = trim($_POST['Dev_ID']);
	$merk = trim($_POST['merk']);
	$type = trim($_POST['type']);
	$date = trim($_POST['date']);
	$waarde = trim($_POST['waarde']);

if(empty($Dev_ID) || empty($merk) || empty($type) || empty($date) || empty($waarde)){
	
	if(empty($Dev_ID)){
		echo "<font color='red'>Computerbarcode niet ingevuld.</font>";
	}
	if(empty($merk)){
		echo "<font color='red'>Merk niet ingevuld.</font>";
	}
	if(empty($type)){
		echo "<font color='red'>Type niet ingevuld.</font>";
	}
	if(empty($date)){
		echo "<font color='red'>Aanschaf datum niet ingevuld.</font>";
	}
	if(empty($waarde)){
		echo "<font color='red'>Aanschaf waarde niet ingevuld.</font>";
	}
	
}else{
	$sql = "UPDATE IA_Randapparatuur
			   SET Dev_ID = :comid,
				   Merk = :merk,
				   Type = :type,
				   Aanschaf_dat = :date,
				   Aanschaf_waarde = :waarde
			 WHERE Rand_ID = :id";
	
	$query = $conn->prepare($sql);
	$query->bindparam(":comid", $Dev_ID);
	$query->bindparam(":merk", $merk);
	$query->bindparam(":type", $type);
	$query->bindparam(":date", $date);
	$query->bindparam(":waarde", $waarde);
	$query->bindparam(":id", $id);
	$query->execute();
	
	$conn = null;
	echo '<meta http-equiv="refresh" content="0;URL=https://portal.basrt.eu/inventadmin/" />';

}
}
?>