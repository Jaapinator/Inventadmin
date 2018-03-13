<?php
	include "../includes/connection.php";
?><style><?php
	include "../includes/style.css";
?></style><?php	

		
		$mon_id = $_GET['edit'];		
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "DELETE FROM IA_Monitor WHERE Mon_ID = $mon_id";
			if ($conn->query($sql)) {
				echo '<meta http-equiv="refresh" content="0;URL=http://webserver03/inventadmin/" />';
			}
			else{
				echo "Iets gaat er fout";
			}

		$conn = null;
	
?>