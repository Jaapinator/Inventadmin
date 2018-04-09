<?php
	include "../includes/connection.php";

		$rand_id = $_GET['edit'];		
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "DELETE FROM IA_Randapparatuur WHERE Rand_ID = $rand_id";
			if ($conn->query($sql)) {
				echo '<meta http-equiv="refresh" content="0;URL=https://portal.basrt.eu/inventadmin/" />';
			}
			else{
				echo "Iets gaat er fout";
			}

		$conn = null;
	
?>