<html><head><link rel="icon" sizes="32x32" type="image/png" href="../favicon.ico"/><title>Inventadmin</title>
<meta http-equiv="X-UA-Compatible" content="IE=edge;" />
<style><?php include "../includes/css/style.css"; ?></style>
<?php include "../includes/connection.php"; ?>
</head>
<body>
	<div class="navbar">
	<a href="http://webserver03/index/login.php">Portal</a>
	<a href="../index.php">Overzicht</a>
	</div>
	<div class="form">
	<H4>Computer koppelen</H4>
	<form method="post" action="insertBound.php" id="bound_form">
		<?php
	$sql = $conn->query("SELECT Com_ID, Barcode FROM IA_Computer"); 
					
					echo "<label>Computerbarcode</label>";
					echo '<select  name="comid" required>'; 
					echo '<option style="display:none" value="">Kies computerbarcode</option>';
					while ($row = $sql->fetch(PDO::FETCH_ASSOC)) {
					   echo '<option value="'.$row['Com_ID'].'">'.$row['Barcode'].'</option>';
					}
					echo '</select>';
	$sql = $conn->query("SELECT Ruimte_ID, Ruimte_naam FROM IA_Locatie"); 
					
					echo "<label>Ruimtenaam</label>";
					echo '<select  name="ruimteid" required>'; 
					echo '<option style="display:none" value="">Kies ruimtenaam</option>';
					while ($row = $sql->fetch(PDO::FETCH_ASSOC)) {
					   echo '<option value="'.$row['Ruimte_ID'].'">'.$row['IA_Locatie'].'</option>';
					}
					echo '</select>';
	$sql = $conn->query("SELECT U_ID, Gebruiker FROM IA_Gebruiker"); 
					
					echo "<label>Gebruiker <i>niet verplicht</i></label>";
					echo '<select  name="userid">'; 
					echo '<option style="display:none" value="">Kies gebruiker van de computer</option>';
					while ($row = $sql->fetch(PDO::FETCH_ASSOC)) {
					   echo '<option value="'.$row['U_ID'].'">'.$row['Gebruiker'].'</option>';
					}
					echo '</select>';
					?>
	<input type="submit" name="submit" value="Koppel">
	</form>
	</div>