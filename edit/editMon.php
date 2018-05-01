<html><head><link rel="icon" sizes="32x32" type="image/png" href="../favicon.ico"/><title>Inventadmin</title>
<meta http-equiv="X-UA-Compatible" content="IE=edge;" /><?php
error_reporting(E_ALL); ini_set('display_errors', 1);
	include "../includes/connection.php";
?><style><?php
	include "../includes/css/style.css";
?></style>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
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
	<a href='https://portal.basrt.eu/index/login.php'>Portal</a>
	<a href='../index.php'>Overzicht</a>
</div>

<?php
	$id = $_GET['edit'];
	
	$sql = "SELECT * FROM IA_Monitor WHERE Mon_ID=:id";
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
	
	$newDate = date("Y-m-d", strtotime($datum));
	}
	
	
?> 
<body>
	<div class="form">
		<H4>Monitor</H4>
		<label>Computer barcode</label>
			<form name="form1" method="post" action="editMon.php?edit=<?php $id; ?>">
			<?php $sql = $conn->query("SELECT Com_ID, Barcode FROM IA_Computer"); 
			
					echo '<select  name="com_id" required>'; 
					while ($row = $sql->fetch(PDO::FETCH_ASSOC)) {
					   echo '<option value="'.$row['Com_ID'].'">'.$row['Barcode'].'</option>';
					}
					echo '</select>';?>
		<label>Monitor barcode</label>
			<input type="text" name="barcode"  value="<?php echo $barcode;?>">
		<label>Merk</label>
			<input type="text" name="merk" value="<?php echo $merk;?>">
		<label>Type</label>
			<input type="text" name="type"  value="<?php echo $type;?>">
		<label>Inch</label>
			<input type="text" name="inch" value="<?php echo $inch;?>">
		<label>Aanschaf datum</label>
			<input type="date" id="picker" name="date" value="<?php echo $newDate;?>">
		<label>Aanschaf waarde</label>
			<input type="text" name="waarde" value="<?php echo $waarde;?>">
			<input type="hidden" name="id" value="<?php echo $_GET['edit'];?>">
			<input type="submit" name="update" value="Update">
		</form>
	</div>
</body>
<?php
if(isset($_POST['update']))
{    
    $id = $_POST['id'];
	
    $com_id = trim($_POST['com_id']);
    $barcode = trim($_POST['barcode']);
    $merk = trim($_POST['merk']);
    $type = trim($_POST['type']);    
    $inch = trim($_POST['inch']);   
    $datum = trim($_POST['date']);    
    $waarde = trim($_POST['waarde']);    
	
    if(empty($com_id) || empty($barcode) || empty($merk) || empty($type) || empty($inch) || empty($datum) || empty($waarde)) {    
            
        if(empty($com_id)) {
            echo "<font color='red'>Computerbarcode niet ingevuld.</font><br/>";
        }
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
        //updating the table
        $sql = "UPDATE IA_Monitor
					SET Com_ID = :com_id,
						Barcode = :barcode, 
						Merk = :merk, 
						Type = :type, 
						Inch = :inch,
						Aanschaf_dat = :datum, 
						Aanschaf_waarde = :waarde 
				  WHERE Mon_ID = :id";
				 
		$query = $conn->prepare($sql);
		$query->bindparam(":com_id", $com_id);
		$query->bindparam(':barcode', $barcode);
		$query->bindparam(':merk', $merk);
		$query->bindparam(':type', $type);
		$query->bindparam(':inch', $inch);
		$query->bindparam(':datum', $datum);
		$query->bindparam(':waarde', $waarde);
		$query->bindparam(':id', $id);
		$query->execute();
		
		$conn = null;
		
		echo '<meta http-equiv="refresh" content="0;URL=https://portal.basrt.eu/inventadmin/" />';
		} 
}
?>