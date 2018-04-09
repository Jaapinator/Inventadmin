<?php
error_reporting(E_ALL); ini_set('display_errors', 1);

	include "../includes/connection.php";
?><style><?php
	include "../includes/style.css";
?></style><?php	


	$soft_id = $_GET['edit'];

		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "DELETE FROM IA_Software_RG WHERE Soft_ID = $soft_id";
			if ($conn->query($sql)) {
				echo '<meta http-equiv="refresh" content="0;URL=https://portal.basrt.eu/inventadmin/" />';
			}
			else{
				echo "Iets gaat er fout";
			}

	$conn = null;

?>