<?php 
error_reporting(E_ALL); ini_set('display_errors', 1);

	include ("../includes/connection.php");

if(isset($_POST['update']))
{    
    $id = $_POST['id'];
	
    $userid = trim($_POST['userid']);
    $nummer = trim($_POST['nummer']);
    $model = trim($_POST['model']);
    $type = trim($_POST['type']);    
    $datum = trim($_POST['date']);    
    $waarde = trim($_POST['waarde']);    
	
    if(empty($userid) || empty($nummer) || empty($merk) || empty($model) || empty($datum) || empty($waarde)) {    
            
        if(empty($userid)) {
            echo "<font color='red'>Gebruiker niet gekozen.</font><br/>";
        }
        if(empty($nummer)) {
            echo "<font color='red'>Telefoonnummer niet ingevuld.</font><br/>";
        }
        if(empty($merk)) {
            echo "<font color='red'>Merk niet ingevuld.</font><br/>";
        }      
		if(empty($model)) {
            echo "<font color='red'>Model niet ingevuld.</font><br/>";
        } 
		if(empty($datum)) {
            echo "<font color='red'>Aanschaf datum niet ingevuld.</font><br/>";
        } 
		if(empty($waarde)) {
            echo "<font color='red'>Aanschaf waarde niet ingevuld.</font><br/>";
        } 
    } else {    
        //updating the table
        $sql = "UPDATE IA_Telefoon
					SET U_ID = :userid,
						Telefoonnummer = :nummer,
						Merk = :merk, 
						Model = :model, 
						Aanschaf_dat = :datum, 
						Aanschaf_waarde = :waarde 
				  WHERE Gsm_ID = :id";
				 
		$query = $conn->prepare($sql);
		$query->bindparam(":userid", $userid);
		$query->bindparam(':nummer', $nummer);
		$query->bindparam(':merk', $merk);
		$query->bindparam(':model', $model);
		$query->bindparam(':datum', $datum);
		$query->bindparam(':waarde', $waarde);
		$query->bindparam(':id', $id);
		$query->execute();
		
		$conn = null;
		
		echo '<meta http-equiv="refresh" content="0;URL=https://portal.basrt.eu/inventadmin/" />';
		} 
}
?>
