<?php 
error_reporting(E_ALL); ini_set('display_errors', 1);

	include ("../includes/connection.php");

if(isset($_POST['update']))
{    
    $id = $_POST['id'];
    
    $comid = trim($_POST['com_id']);
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
					SET Com_ID = :comid,
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
