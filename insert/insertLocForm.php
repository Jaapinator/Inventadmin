<html><head><link rel="icon" sizes="32x32" type="image/png" href="../favicon.ico"/><title>Inventadmin</title>
<meta http-equiv="X-UA-Compatible" content="IE=edge;" /><?php 
	include "../includes/connection.php";
?><style><?php
	include "../includes/css/style.css";
?></style><?php
	echo "<div class='navbar'>";
	echo "<a href='https://portal.basrt.eu/index/login.php'>Portal</a>";
	echo "<a href='../index.php'>Overzicht</a>";
	echo "</div>";
		echo "<div class='form'>";
		echo "<H4> Voeg een locatie toe</H4>";
			echo "<form method='post' action='insertLoc.php'>";
				echo "<label>Locatienaam</label>";
				echo "<input type='text' name='ruimte_naam' placeholder='Naam'>";
				echo "<input type='submit' name='submit' value='Voeg toe'>";
			echo "</form>";
		echo "</div>";
	?>