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
			echo "<H4> Voeg gebruiker toe</H4>";
				echo "<form method='post' action='insertUser.php'>";
					$sql = $conn->query("SELECT Com_ID, Barcode FROM IA_Computer"); 
					echo "<label>Computer barcode</label>";
					echo '<select  name="com_id" required>'; 
					echo '<option style="display:none" value="" ">Kies barcode van computer</option>';
					while ($row = $sql->fetch(PDO::FETCH_ASSOC)) {
					   echo '<option value="'.$row['Com_ID'].'">'.$row['Barcode'].'</option>';
					}
					echo '</select>';
					echo '<a href="insertComForm.php">Computer bestaat nog niet? Voeg hem hier toe</a><br><br>'; 
					$sql = $conn->query("SELECT Ruimte_ID, Ruimte_naam FROM IA_Locatie ORDER BY Ruimte_naam");
					echo "<label>Ruimte naam</label>";
					echo '<select  name="ruimte_id" required>'; 
					echo '<option style="display:none" value="" ">Kies locatie</option>';
					while ($row = $sql->fetch(PDO::FETCH_ASSOC)) {
					   echo '<option value="'.$row['Ruimte_ID'].'">'.$row['Ruimte_naam'].'</option>';
					}
					echo '</select>';
					echo '<a href="insertLocForm.php">Locatie bestaat nog niet? Voeg hem hier toe</a><br><br>';

				
				echo "<label>Naam</label>";
				echo "<input type='text' name='gebruiker' placeholder='Gebruiker' required>";	
				echo "<label>E-mail</label>";
				echo "<input type='email' name='email' placeholder='E-mail' required>";	
				
				echo "<input type='submit' name='submit2' value='voeg toe'>";
				echo "</form>";
			echo "</div>";

	
?>