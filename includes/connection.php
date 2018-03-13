<?php

		$server = "basserver5\prins";
		$conn = new PDO('sqlsrv:server='.$server.';database=Inventadmin', 'inventadmin', 'A6nR4mojCvTAxfRl82Yi');
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		//echo "Connection successfully <br>";

?>