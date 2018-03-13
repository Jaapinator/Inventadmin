<html><head><link rel="icon" sizes="32x32" type="image/png" href="../favicon.ico"/><title>Inventadmin</title>
<meta http-equiv="X-UA-Compatible" content="IE=edge;" /><?php
error_reporting(E_ALL); ini_set('display_errors', 1);
	include "../includes/connection.php";
?><style><?php
	include "../includes/css/style.css";
?></style><script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
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
	<a href='http://webserver03/index/login.php'>Portal</a>
	<a href='../index.php'>Overzicht</a>
</div>

<?php
	$id = $_GET['edit'];
	
	$sql = "SELECT IA_Software.Soft_naam, IA_Computer.Barcode, IA_Software.Versie, IA_Software_RG.Aanschaf_dat, IA_Software_RG.Aanschaf_waarde, IA_Software_RG.Soft_ID, IA_Software_RG.Com_ID FROM IA_Computer, IA_Software, IA_Software_RG WHERE IA_Software_RG.Soft_ID=:id AND IA_Software.Soft_ID=IA_Software_RG.Soft_ID AND IA_Computer.Com_ID=IA_Software_RG.Com_ID";
	$query = $conn->prepare($sql);
	$query->execute(array(':id' => $id));

	while($row = $query->fetch(PDO::FETCH_ASSOC))
	{
	$barcode = $row['Barcode'];
	$soft_id = $row['Soft_ID'];
	$com_id = $row['Com_ID'];
    $soft_naam = $row['Soft_naam'];
    $versie = $row['Versie'];
    $datum = $row['Aanschaf_dat'];
    $waarde = $row['Aanschaf_waarde'];
	
	$newDate = date("Y-m-d", strtotime($datum));
	}
	
	
?> 
<body>
	<div class="form">
		<H4>Software</H4>
		<form name="form1" method="post" action="updateSoft.php">
			<label>Computer barcode</label>
			<?php $sql = $conn->query("SELECT Barcode, Com_ID FROM IA_Computer WHERE Barcode<>$barcode"); ?>
			
					<select  name="com_id" required>
					<option value="<?php echo $com_id; ?>" selected><?php echo $barcode ?></option><?php
					while ($row = $sql->fetch(PDO::FETCH_ASSOC)) {
					   echo '<option value="'.$row['Com_ID'].'">'.$row['Barcode'].'</option>';
					}?>
					</select>
			<label>Software & Versie</label>
			<?php $sql = $conn->query("SELECT Soft_ID, Soft_naam, Versie FROM IA_Software "); ?>
			
					<select  name="soft_id" required>
					<option value="<?php echo $soft_id; ?>" selected><?php echo $soft_naam;?> <?php echo $versie;?></option> <?php
					while ($row = $sql->fetch(PDO::FETCH_ASSOC)) {
					   echo '<option value="'.$row['Soft_ID'].'">'.$row['Soft_naam'].' '.$row['Versie'].'</option>';
					} ?>
					</select>
			<label>Aanschaf datum</label>
			<input type="date" id="picker" name="date" value="<?php echo $newDate;?>">
			<label>Aanschaf waarde</label>
			<input type="number" name="waarde" value="<?php echo number_format((float)$waarde, 2, '.', '');?>">
			<input type="hidden" name="id" value="<?php echo $_GET['edit'];?>">
			<input type="submit" name="update" value="Update">
		</form>
	</div>
</body>