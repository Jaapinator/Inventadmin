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
	
	$sql = "SELECT IA_Computer.Barcode, IA_Randapparatuur.Com_ID, Merk, Type, IA_Randapparatuur.Aanschaf_dat, IA_Randapparatuur.Aanschaf_waarde FROM IA_Randapparatuur, IA_Computer WHERE Rand_ID=:id AND IA_Computer.Com_ID=IA_Randapparatuur.Com_ID";
	$query = $conn->prepare($sql);
	$query->execute(array(':id' => $id));

	while($row = $query->fetch(PDO::FETCH_ASSOC))
	{
	$barcode = $row['Barcode'];
	$com_id = $row['Com_ID'];
    $merk = $row['Merk'];
    $type = $row['Type'];
    $datum = $row['Aanschaf_dat'];
    $waarde = $row['Aanschaf_waarde'];
	
	$newDate = date("Y-m-d", strtotime($datum));
	}
?> 
<body>
	<div class="form">
		<H4>Randapparatuur</H4>
		<form name="form1" method="post" action="editRand.php?edit=<?php $id; ?>">
			<label>Computer barcode</label>
			<?php $sql = $conn->query("SELECT Barcode, Com_ID FROM IA_Computer WHERE Barcode<>$barcode"); ?>
			
					<select  name="com_id" required>
					<option value="<?php echo $com_id; ?>" selected><?php echo $barcode ?></option><?php
					while ($row = $sql->fetch(PDO::FETCH_ASSOC)) {
					   echo '<option value="'.$row['Com_ID'].'">'.$row['Barcode'].'</option>';
					}?>
					</select>
			<label>Merk</label>
			<input type="text" name="merk" value="<?php echo $merk;?>">
			<label>Type</label>
			<input type="text" name="type" value="<?php echo $type;?>">
			<label>Aanschaf datum</label>
			<input type="date" id="picker" name="date" value="<?php echo $newDate;?>">
			<label>Aanschaf waarde</label>
			<input type="number" name="waarde" value="<?php echo $waarde;?>">
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
    
	$com_id = trim($_POST['com_id']);
	$merk = trim($_POST['merk']);
	$type = trim($_POST['type']);
	$date = trim($_POST['date']);
	$waarde = trim($_POST['waarde']);

if(empty($com_id) || empty($merk) || empty($type) || empty($date) || empty($waarde)){
	
	if(empty($com_id)){
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
			   SET Com_ID = :comid,
				   Merk = :merk,
				   Type = :type,
				   Aanschaf_dat = :date,
				   Aanschaf_waarde = :waarde
			 WHERE Rand_ID = :id";
	
	$query = $conn->prepare($sql);
	$query->bindparam(":comid", $com_id);
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