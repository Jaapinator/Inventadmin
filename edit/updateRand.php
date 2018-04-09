<?php 
error_reporting(E_ALL); ini_set('display_errors', 1);

	include ("../includes/connection.php");

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