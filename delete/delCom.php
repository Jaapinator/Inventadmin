<p style="color:red;">Hij kon de computer niet verwijderen omdat er nog monitors, software of een gebruiker aan gekoppeld waren. Klik <a href='../index.php'>hier</a> om terug te gaan naar het overzicht.</p>
<?php
	include "../includes/connection.php";
?><style><?php
	include "../includes/style.css";
?></style><?php	
		
		$com_id = $_REQUEST['edit'];
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "DELETE FROM IA_Computer WHERE Com_ID = $com_id";
			if ($conn->query($sql)) {
				echo '<meta http-equiv="refresh" content="0;URL=http://webserver03/inventadmin/" />';
			}
			else{
				echo "Iets gaat er fout";
			}
	
		$conn = null;
	
?>
