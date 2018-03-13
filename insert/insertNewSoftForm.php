<html><head><link rel="icon" sizes="32x32" type="image/png" href="../favicon.ico"/><title>Inventadmin</title>
<meta http-equiv="X-UA-Compatible" content="IE=edge;" /><?php
	include "../includes/connection.php";
?><style><?php
	include "../includes/css/style.css";
?></style><?php

	echo "<div class='navbar'>";
	echo "<a href='http://webserver03/index/login.php'>Portal</a>";
	echo "<a href='../index.php'>Overzicht</a>";
	echo "</div>";
			echo "<div class='form'>";
			echo "<H4> Voeg een programma toe</H4>";
				echo "<form id='soft_form' action='insertNewSoft.php' method='post'>";
				echo "<label>Softwarenaam</label>";
				echo "<input type='text' name='soft_naam' placeholder='Software naam' required>";
				echo "<label>Versie</label>";
				echo "<input type='text' name='soft_versie' placeholder='Versie' required>";
				echo "<input type='submit' name='submit4' value='voeg toe'>";
				echo "</form>";
			echo "</div>";
			
?>