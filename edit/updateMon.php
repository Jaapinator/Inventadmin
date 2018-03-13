<?php 
error_reporting(E_ALL); ini_set('display_errors', 1);

	include ("../includes/connection.php");

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
		
		echo '<meta http-equiv="refresh" content="0;URL=http://webserver03/inventadmin/" />';
		} 
}
?>
