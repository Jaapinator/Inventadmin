<?php 
error_reporting(E_ALL); ini_set('display_errors', 1);

	include ("../includes/connection.php");

if(isset($_POST['update']))
{    
    $id = $_POST['id'];
    
    $com_id = $_POST['com_id'];
    $ruimte_id = $_POST['ruimte_id'];
    $user = trim($_POST['user']);    
    $mail = trim($_POST['mail']);     
	
    if(empty($com_id) || empty($ruimte_id) || empty($user) || empty($mail)) {    
            
        if(empty($com_id)) {
            echo "<font color='red'>Barcode niet ingevuld.</font><br/>";
        }
        if(empty($ruimte_id)) {
            echo "<font color='red'>Ruimte niet ingevuld.</font><br/>";
        }
        if(empty($user)) {
            echo "<font color='red'>Gebruikersnaam niet ingevuld.</font><br/>";
        }      
		if(empty($mail)) {
            echo "<font color='red'>E-mail niet ingevuld.</font><br/>";
        } 
    } else {    
        //updating the table
        $sql = "UPDATE IA_Gebruiker
					SET Com_ID = :com_id,
						Ruimte_ID = :ruimte_id, 
						Gebruiker = :naam, 
						Mailadres = :mail
				  WHERE U_ID = :id";
				 
		$query = $conn->prepare($sql);
		$query->bindparam(":com_id", $com_id);
		$query->bindparam(':ruimte_id', $ruimte_id);
		$query->bindparam(':naam', $user);
		$query->bindparam(':mail', $mail);
		$query->bindparam(':id', $id);
		$query->execute();
		
		$conn = null;
		
		echo '<meta http-equiv="refresh" content="0;URL=https://portal.basrt.eu/inventadmin/" />';
		} 
}
?>
