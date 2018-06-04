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
<style>
input, select{
	max-width: 275px;
}
</style>
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

<?php
	$id = $_GET['edit'];
	$sql = "SELECT *, (SELECT Barcode FROM IA_Devices WHERE IA_Devices.Dev_ID=IA_Monitor.Dev_ID) as combar FROM IA_Monitor WHERE Mon_ID=:id";
	$query = $conn->prepare($sql);
	$query->execute(array(':id' => $id));

	while($row = $query->fetch(PDO::FETCH_ASSOC))
	{
    $barcode = $row['Barcode'];
    $merk = $row['Merk'];
    $type = $row['Type'];
    $inch = $row['Inch'];
    $datum = $row['Aanschaf_dat'];
    $waarde = $row['Aanschaf_waarde'];
	$combarcode = $row['combar'];
	$comid = $row['Dev_ID'];
	$newDate = date("Y-m-d", strtotime($datum));
	}
	
?> 

<div class="container">
	<div class="main-login main-center">
		<H4>Monitor</H4>
		<hr>
			<form name="form1" method="post" action="editMon.php?edit=<?php $id; ?>">
		<div class="form-group">
		<label class="control-label col-sm-2" for="Dev_ID">Computer barcode:</label>
			<div class="col-sm-10">
			<?php $sql = $conn->query("SELECT Dev_ID, Barcode FROM IA_Devices"); ?>
			
					<select  name="Dev_ID">
					<option value="<?php echo $comid; ?>" selected><?php echo $combarcode ?></option>
					<option value=""> Geen computer</option>
			<?php	while ($row = $sql->fetch(PDO::FETCH_ASSOC)) {
					   echo '<option value="'.$row['Dev_ID'].'">'.$row['Barcode'].'</option>';
					} ?>
					</select>
			</div>
		</div>
		<div class="form-group">
			<label class="control-label col-sm-2" for="barcode">Monitor barcode:</label>
			<div class="col-sm-10">
				<input type='text' name='barcode' value='<?php echo $barcode;?>' class='form-control' required>
			</div>
		</div>
		<div class="form-group">
			<label class="control-label col-sm-2" for="merk">Merk:</label>
			<div class="col-sm-10">
				<input type='text' name='merk' value='<?php echo $merk;?>' class='form-control' required>
			</div>
		</div>
		<div class="form-group">
			<label class="control-label col-sm-2" for="type">Type:</label>
			<div class="col-sm-10">
				<input type='text' name='type' value='<?php echo $type;?>' class='form-control' required>
			</div>
		</div>
		<div class="form-group">
			<label class="control-label col-sm-2" for="inch">Inch:</label>
			<div class="col-sm-10">
				<input type='text' name='inch' value='<?php echo $inch;?>' class='form-control' required>
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
<?php
if(isset($_POST['update']))
{    
    $id = $_POST['id'];
	
    $Dev_ID = trim($_POST['Dev_ID']);
    $barcode = trim($_POST['barcode']);
    $merk = trim($_POST['merk']);
    $type = trim($_POST['type']);    
    $inch = trim($_POST['inch']);   
    $datum = trim($_POST['date']);    
    $waarde = trim($_POST['waarde']);    
	
    if(empty($barcode) || empty($merk) || empty($type) || empty($inch) || empty($datum) || empty($waarde)) {    
        
        if(empty($barcode)) {
            echo "<font color='red'>Monitorbarcode niet ingevuld.</font><br/>";
        }
        if(empty($merk)) {
            echo "<font color='red'>Merk niet ingevuld.</font><br/>";
        }      
		if(empty($type)) {
            echo "<font color='red'>Type niet ingevuld.</font><br/>";
        } 
		if(empty($inch)) {
            echo "<font color='red'>Inch niet ingevuld.</font><br/>";
        } 
		if(empty($datum)) {
            echo "<font color='red'>Aanschaf datum niet ingevuld.</font><br/>";
        } 
		if(empty($waarde)) {
            echo "<font color='red'>Aanschaf waarde niet ingevuld.</font><br/>";
        } 
    } else {    
		if($Dev_ID == 0){
		$sql = "UPDATE IA_Monitor
					SET Dev_ID = NULL,
						Barcode = :barcode, 
						Merk = :merk, 
						Type = :type, 
						Inch = :inch,
						Aanschaf_dat = :datum, 
						Aanschaf_waarde = :waarde 
				  WHERE Mon_ID = :id";
				 
		$query = $conn->prepare($sql);
		$query->bindparam(':barcode', $barcode);
		$query->bindparam(':merk', $merk);
		$query->bindparam(':type', $type);
		$query->bindparam(':inch', $inch);
		$query->bindparam(':datum', $datum);
		$query->bindparam(':waarde', $waarde);
		$query->bindparam(':id', $id);
		$query->execute();
		
		echo '<meta http-equiv="refresh" content="0;URL=https://portal.basrt.eu/inventadmin/" />';
		}else{
        //updating the table
        $sql = "UPDATE IA_Monitor
					SET Dev_ID = :Dev_ID,
						Barcode = :barcode, 
						Merk = :merk, 
						Type = :type, 
						Inch = :inch,
						Aanschaf_dat = :datum, 
						Aanschaf_waarde = :waarde 
				  WHERE Mon_ID = :id";
				 
		$query = $conn->prepare($sql);
		$query->bindparam(":Dev_ID", $Dev_ID);
		$query->bindparam(':barcode', $barcode);
		$query->bindparam(':merk', $merk);
		$query->bindparam(':type', $type);
		$query->bindparam(':inch', $inch);
		$query->bindparam(':datum', $datum);
		$query->bindparam(':waarde', $waarde);
		$query->bindparam(':id', $id);
		$query->execute();
		
		echo '<meta http-equiv="refresh" content="0;URL=https://portal.basrt.eu/inventadmin/" />';
		}
		$conn = null;
		} 
}
?>