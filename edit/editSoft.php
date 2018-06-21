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
	
	$sql = "SELECT IA_Software.Soft_naam, IA_Devices.Barcode, IA_Software.Versie, IA_Software_RG.Aanschaf_dat, IA_Software_RG.Aanschaf_waarde, IA_Software_RG.Soft_ID, IA_Software_RG.Dev_ID FROM IA_Devices, IA_Software, IA_Software_RG WHERE IA_Software_RG.Soft_ID=:id AND IA_Software.Soft_ID=IA_Software_RG.Soft_ID AND IA_Devices.Dev_ID=IA_Software_RG.Dev_ID";
	$query = $conn->prepare($sql);
	$query->execute(array(':id' => $id));

	while($row = $query->fetch(PDO::FETCH_ASSOC))
	{
	$barcode = $row['Barcode'];
	$soft_id = $row['Soft_ID'];
	$Dev_ID = $row['Dev_ID'];
    $soft_naam = $row['Soft_naam'];
    $versie = $row['Versie'];
    $datum = $row['Aanschaf_dat'];
    $waarde = $row['Aanschaf_waarde'];
	
	$newDate = date("Y-m-d", strtotime($datum));
	}
	
	
?> 
<body>
<div class="container">
	<div class="main-login main-center">
		<H4>Software</H4>
		<hr>
			<form name="form1" method="post" action="editSoft.php?edit=<?php $id; ?>">
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
		<label class="control-label col-sm-2" for="soft_id">Software & versie:</label>
			<div class="col-sm-10">
			<?php $sql = $conn->query("SELECT Soft_ID, Soft_naam, Versie FROM IA_Software "); ?>
			
					<select  name="soft_id" required>
					<option value="<?php echo $soft_id; ?>" selected><?php echo $soft_naam;?> <?php echo $versie;?></option> <?php
					while ($row = $sql->fetch(PDO::FETCH_ASSOC)) {
					   echo '<option value="'.$row['Soft_ID'].'">'.$row['Soft_naam'].' '.$row['Versie'].'</option>';
					} ?>
					</select>
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
    
    $comid = trim($_POST['Dev_ID']);
    $softid = trim($_POST['soft_id']);      
    $datum = trim($_POST['date']);    
    $waarde = trim($_POST['waarde']);    
	

    if(empty($comid) || empty($softid) || empty($datum) || empty($waarde)) {    
            
        if(empty($comid)) {
            echo "<font color='red'>Computerbarcode niet ingevuld.</font><br/>";
        }
        if(empty($softid)) {
            echo "<font color='red'>Softwarenaam en versie niet ingevuld.</font><br/>";
        }      
		if(empty($datum)) {
            echo "<font color='red'>Aanschaf datum niet ingevuld.</font><br/>";
        } 
		if(empty($waarde)) {
            echo "<font color='red'>Aanschaf waarde niet ingevuld.</font><br/>";
        } 
    } else {    
        //updating the table
        $sql = "UPDATE IA_Software_RG
					SET Dev_ID = :comid,
						Soft_ID = :softid, 
						Aanschaf_dat = :datum, 
						Aanschaf_waarde = :waarde 
				  WHERE Soft_ID = :id";
				 
		$query = $conn->prepare($sql);
		$query->bindparam(":comid", $comid);
		$query->bindparam(':softid', $softid);
		$query->bindparam(':datum', $datum);
		$query->bindparam(':waarde', $waarde);
		$query->bindparam(':id', $id);
		$query->execute();
		
		$conn = null;
		
		echo '<meta http-equiv="refresh" content="0;URL=https://portal.basrt.eu/inventadmin/" />';
		} 
}
?>