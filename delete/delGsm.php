<p style="color:red;">Hij kon de computer niet verwijderen omdat er nog monitors, software of een gebruiker aan gekoppeld waren. Klik <a href='../index.php'>hier</a> om terug te gaan naar het overzicht.</p>
<?php
	include "../includes/connection.php";
?><style><?php
	include "../includes/style.css";
?></style><?php	
		
		$gsm_id = $_REQUEST['edit'];
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "DELETE FROM IA_Telefoon WHERE Gsm_ID = $gsm_id";
			if ($conn->query($sql)) {
				echo '<meta http-equiv="refresh" content="0;URL=https://portal.basrt.eu/inventadmin/" />';
			}
			else{
				echo "Iets gaat er fout";
			}
	
		$conn = null;
	
?>
