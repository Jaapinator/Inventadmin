<html><head><link rel="icon" sizes="32x32" type="image/png" href="favicon.ico"/><title>Inventadmin</title>
<meta http-equiv="X-UA-Compatible" content="IE=edge;" />
<?php
error_reporting(E_ALL); ini_set('display_errors', 1);
	include "includes/connection.php";
	include "includes/scripts.php";
?>
		  <script> <?php include "includes/js/my_js.js"; ?> </script>	
		 <script><?php include "includes/js/menuswitch.js"; ?>	</script>
		 <script><?php include "includes/js/scanner.js"; ?> </script> 
		 <script><?php include "../includes/js/maxtime.js" ?> </script> 
  <script type="text/javascript" src="includes/js/quagga.min.js"></script>
		 </head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top">
	 <a class="navbar-brand" href="https://portal.basrt.eu/">Inventadmin</a>
		  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		  </button>
		  <div class="collapse navbar-collapse" id="navbarNavDropdown">
			<ul class="navbar-nav">
			  <li class="nav-item dropdown">
				<a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				  Item toevoegen
				</a>
				<div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
				    <a class="dropdown-item" href='insert/insertComForm.php'>Apparaat</a>
					<a class="dropdown-item" href='insert/insertMonForm.php'>Monitor</a>
					<a class="dropdown-item" href='insert/insertSoftForm.php'>Software</a>
					<a class="dropdown-item" href='insert/insertRandForm.php'>Randapparatuur</a>
					<a class="dropdown-item" href='insert/insertGsmForm.php'>Telefoon</a>
				</div>
			  </li>
			  <li class="nav-item">
				<a class="nav-link" href='insert/bound.php'>Apparaat koppelen</a>
			  </li>
			  <li class="nav-item">
				<a class="nav-link" href='insert/insertUserForm.php'>Gebruiker toevoegen</a>
			  </li>
			  <li class="nav-item">
				<a class="nav-link" href="#" data-toggle="modal" data-target="#myModal">Barcode scanner</a>
			  </li>
		<select id='drop' class='keuze' style="float:right;">
		<option class='keuze' value='table1' selected>Apparaat</option>
		<option class='keuze' value='table2'>Monitor</option>
		<option class='keuze' value='table3'>Software</option>
		<option class='keuze' value='table4'>Gebruiker</option>
		<option class='keuze' value='table5'>Randapparatuur</option>
		<option class='keuze' value='table6'>Telefoon</option>
		</select>
		</ul>
	</div>
</nav>



<div class="modal fade" id="myModal">
	<div class="modal-dialog">
			<span class="found"></span>
			<div id="interactive" class="viewport"></div>
	</div>
</div>	

<div id='divtable1' class='table' style="margin-top:17px;">
	<table id='table1' class='table table-striped table-bordered' cellspacing='0' width='100%' > 
		<thead><tr><th>Barcode</th><th>Computernaam</th><th>Ip-adres</th><th>CPU</th><th>RAM</th><th>Moederbord</th><th>Aanschaf datum</th><th></th></tr></thead><tbody>
		<?php 
		$stmt = $conn->query('SELECT *, (SELECT U_ID FROM IA_Locatie_RG WHERE IA_Locatie_RG.Dev_ID=IA_Devices.Dev_ID) as usr FROM IA_Devices ORDER BY Barcode');
		while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
			$newDate = date("d-m-Y", strtotime($row['Aanschaf_dat']));
			echo "<tr><td>";
			echo $row['Barcode'];
			echo "</td><td>";
			echo strip_tags($row['Naam']);
			echo "</td><td>";
			if($row['Ip_adres'] == NULL) { echo "DHCP"; } else { echo $row['Ip_adres']; }
			echo "</td><td>";
			echo strip_tags($row['CPU']);
			echo "</td><td>";
			echo strip_tags($row['Memory']);
			echo "</td><td>";
			echo strip_tags($row['Moederbord']);
			echo "</td><td >";
			echo $row['Aanschaf_dat']; ?>
			</td><td class='knoppen'><?php
			if($row['usr'] == NULL) {  } else { echo "<a class='btn btn-outline-info btn-sm' style='margin-right:5px;' href='view.php?view=$row[usr]' ><i class='fas fa-eye fa-s'></i> View</a>"; }
			echo "<a class='btn btn-outline-success btn-sm' style='margin-right:5px;' href='edit/editCom.php?edit=$row[Dev_ID]' ><i class='far fa-edit fa-s'></i> Edit</a>";
			echo "<a class='btn btn-outline-danger btn-sm' href='delete/delCom.php?edit=$row[Dev_ID]' onClick=\"return confirm('Weet je zeker dat je dit item wilt verwijderen?')\"><i class='far fa-trash-alt fa-s'></i> Delete</a>
			</td></tr>";
	 	} ?>
	</tbody></table>
</div>

<div id='divtable2' class='table' >
	<table id='table2' class='table table-striped table-bordered' cellspacing='0' width='100%'>
		<thead><tr><th>Computerbarcode</th><th>Monitorbarcode</th><th>Merk</th><th>Type</th><th>Inch</th><th>Aanschaf datum</th><th>Aanschaf Waarde</th><th></th></tr></thead><tbody>	
	<?php $stmt = $conn->query('SELECT *, (SELECT Barcode FROM IA_Devices WHERE IA_Devices.Dev_ID=IA_Monitor.Dev_ID) as bar FROM IA_Monitor');
		while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
			$waarde = $row['Aanschaf_waarde'];
			$originalDate = $row['Aanschaf_dat'];
			$newDate = date("d-m-Y", strtotime($originalDate));
			echo "<tr><td>";
			if($row['Dev_ID'] == NULL) { echo "Geen computer"; } else { echo $row['bar']; }
			echo "</td><td>";
			echo $row['Barcode'];
			echo "</td><td>";
			echo strip_tags($row['Merk']);
			echo "</td><td>";
			echo strip_tags($row['Type']);
			echo "</td><td>";
			echo $row['Inch'];
			echo "</td><td>";
			echo $newDate;
			echo "</td><td>";
			echo "&euro;"; echo number_format((float)$waarde, 2, '.', ''); ?>
			</td><td class='knoppen'> <?php
			if($row['Dev_ID'] == NULL) {  } else { echo "<a class='btn btn-outline-info btn-sm' style='margin-right:5px;' href='view.php?view=$row[Dev_ID]' ><i class='fas fa-eye fa-s'></i> View</a>"; }
			echo "<a class='btn btn-outline-success btn-sm' style='margin-right:5px;' href='edit/editMon.php?edit=$row[Mon_ID]' ><i class='far fa-edit fa-s'></i> Edit</a>";			
			echo "<a class='btn btn-outline-danger btn-sm' href='delete/delMon.php?edit=$row[Mon_ID]' onClick=\"return confirm('Weet je zeker dat je dit item wilt verwijderen?')\"><i class='far fa-trash-alt fa-s'></i> Delete</a>";
			echo "</td></tr>";
		} ?>
</tbody></table>
	</div>

	<div id='divtable3' class='table' >
	<table id='table3' class='table table-striped table-bordered' cellspacing='0' width='100%'> 
		<thead><tr><th>Computerbarcode</th><th>Softnaam</th><th>Versie</th><th>Aanschaf datum</th><th>Aanschaf Waarde</th><th></th></tr></thead><tbody>	
	<?php $stmt = $conn->query('SELECT *, IA_Software_RG.Soft_ID as rid, IA_Locatie_RG.U_ID as usr FROM IA_Software, IA_Devices, IA_Software_RG, IA_Locatie_RG WHERE IA_Devices.Dev_ID=IA_Software_RG.Dev_ID AND IA_Software.Soft_ID=IA_Software_RG.Soft_ID AND IA_Devices.Dev_ID=IA_Locatie_RG.Dev_ID');
		while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
			$waarde = $row['Aanschaf_waarde'];
			$originalDate = $row['Aanschaf_dat'];
			$newDate = date("d-m-Y", strtotime($originalDate));
			echo "<tr><td>";
			echo $row['Barcode'];
			echo "</td><td>";
			echo strip_tags($row['Soft_naam']);
			echo "</td><td>";
			echo strip_tags($row['Versie']);
			echo "</td><td>";
			echo $newDate;
			echo "</td><td>";
			echo "&euro;"; echo number_format((float)$waarde, 2, '.', ''); ?>
			</td><td class='knoppen'> <?php
			echo "<a class='btn btn-outline-info btn-sm' style='margin-right:5px;' href='view.php?view=$row[usr]' ><i class='fas fa-eye fa-s'></i> View</a>";
			echo "<a class='btn btn-outline-success btn-sm' style='margin-right:5px;' href='edit/editSoft.php?edit=$row[rid]' ><i class='far fa-edit fa-xs'></i> Edit</a>";
			echo "<a class='btn btn-outline-danger btn-sm' href='delete/delSoft.php?edit=$row[rid]' onClick=\"return confirm('Weet je zeker dat je dit item wilt verwijderen?')\"><i class='far fa-trash-alt fa-xs'></i> Delete</a>";
			echo "</td></tr>";
		} ?>
</tbody></table>
	</div>


	<div id='divtable4' class='table' >
	<table id='table4' class='table table-striped table-bordered' cellspacing='0' width='100%'>
		<thead><tr><th>Computerbarcode</th><th>Ip-adres</th><th>Locatie</th><th>Gebruikersnaam</th><th>E-mail</th><th></th></tr></thead><tbody>
		<?php $stmt = $conn->query('SELECT Dev_ID as comid, (SELECT Barcode FROM IA_Devices WHERE IA_Locatie_RG.Dev_ID=IA_Devices.Dev_ID) as bar, (SELECT Ip_adres FROM IA_Devices WHERE IA_Locatie_RG.Dev_ID=IA_Devices.Dev_ID) as Ip_adres, (SELECT Ruimte_naam FROM IA_Locatie WHERE IA_Locatie_RG.Ruimte_ID=IA_Locatie.Ruimte_ID) as Ruimte_naam, (SELECT Gebruiker FROM IA_Gebruiker WHERE IA_Gebruiker.U_ID=IA_Locatie_RG.U_ID) as Gebruiker, (SELECT Mailadres FROM IA_Gebruiker WHERE IA_Gebruiker.U_ID=IA_Locatie_RG.U_ID) as Mailadres, (SELECT U_ID FROM IA_Gebruiker WHERE IA_Gebruiker.U_ID=IA_Locatie_RG.U_ID) as usr FROM IA_Locatie_RG;');
		while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
			$gebruiker = $row['Gebruiker'];
			echo "<tr><td>";
			if($row['comid'] == NULL) { echo "Geen computer"; } else { echo $row['bar']; }
			echo "</td><td>";
			echo strip_tags($row['Ip_adres']);
			echo "</td><td>";
			echo strip_tags($row['Ruimte_naam']);
			echo "</td><td>";
			echo $gebruiker;
			echo "</td><td>";
			echo strip_tags($row['Mailadres']); ?>
			</td><td class='knoppen'> <?php
			if($row['comid'] == NULL) {  } else { echo "<a class='btn btn-outline-info btn-sm' style='margin-right:5px;' href='view.php?view=$row[usr]' ><i class='fas fa-eye fa-s'></i> View</a>"; }
			echo "<a class='btn btn-outline-success btn-sm' style='margin-right:5px;' href='edit/editUser.php?edit=$row[usr]' ><i class='far fa-edit fa-s'></i> Edit</a>"; 
			echo "<a class='btn btn-outline-danger btn-sm' href='delete/delUser.php?edit=$row[usr]' onClick=\"return theFunction();\"><i class='far fa-trash-alt fa-s'></i> Delete</a>";
			echo "</td></tr>";
		} ?>
</tbody></table>
</div>
<script type="text/javascript">
   function theFunction () {
   var php_var = "<?php echo $gebruiker; ?>";
   confirm("Weet je zeker dat je "+ php_var +" wilt verwijderen?");
   }
</script>
	<div id='divtable5' class='table' >
	<table id='table5' class='table table-striped table-bordered' cellspacing='0' width='100%'>
		<thead><tr><th>Computerbarcode</th><th>Merk</th><th>Type</th><th>Aanschaf datum</th><th>Aanschaf waarde</th><th></th></tr></thead><tbody> 	
	<?php	$stmt = $conn->query('SELECT IA_Devices.Barcode, IA_Randapparatuur.Merk, IA_Randapparatuur.Type, IA_Randapparatuur.Aanschaf_waarde, IA_Randapparatuur.Aanschaf_dat, Rand_ID FROM IA_Randapparatuur, IA_Devices WHERE IA_Randapparatuur.Dev_ID=IA_Devices.Dev_ID');
		while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
			$newDate = date("d-m-Y", strtotime($row['Aanschaf_dat']));
			echo "<tr><td>";
			echo $row['Barcode'];
			echo "</td><td>";
			echo strip_tags($row['Merk']);
			echo "</td><td>";
			echo strip_tags($row['Type']);
			echo "</td><td>";
			echo $newDate;
			echo "</td><td>";
			echo "&euro;"; echo number_format((float)$row['Aanschaf_waarde'], 2, '.', ''); ?>
			</td><td class='knoppen'>  <?php
			echo "<a class='btn btn-outline-success btn-sm' style='margin-right:5px;' href='edit/editRand.php?edit=$row[Rand_ID]' ><i class='far fa-edit fa-xs'></i> Edit</a>";
			
			echo "<a class='btn btn-outline-danger btn-sm' href='delete/delRand.php?edit=$row[Rand_ID]' onClick=\"return confirm('Weet je zeker dat je dit item wilt verwijderen?')\"><i class='far fa-trash-alt fa-xs'></i> Delete</a>";
			echo "</td></tr>";
		} ?>
</tbody></table>
</div>

	<div id='divtable6' class='table' >
	<table id='table6' class='table table-striped table-bordered' cellspacing='0' width='100%'>
		<thead><tr><th>Gebruiker</th><th>Telefoonnummer</th><th>Merk</th><th>Model</th><th>Aanschaf datum</th><th>Aanschaf waarde</th><th></th></tr></thead><tbody> 	
	<?php	$stmt = $conn->query('SELECT IA_Gebruiker.U_ID as usr, Gsm_ID, Gebruiker, Telefoonnummer, Merk, Model, Aanschaf_dat, Aanschaf_waarde FROM IA_Gebruiker, IA_Telefoon WHERE IA_Gebruiker.U_ID=IA_Telefoon.U_ID');
		while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
			$newDate = date("d-m-Y", strtotime($row['Aanschaf_dat']));
			echo "<tr><td>";
			echo strip_tags($row['Gebruiker']);
			echo "</td><td>";
			echo strip_tags($row['Telefoonnummer']);
			echo "</td><td>";
			echo strip_tags($row['Merk']);
			echo "</td><td>";
			echo strip_tags($row['Model']);
			echo "</td><td>";
			echo $newDate;
			echo "</td><td>";
			echo "&euro;"; echo number_format((float)$row['Aanschaf_waarde'], 2, '.', ''); ?>
			</td><td class='knoppen'> <?php
			echo "<a class='btn btn-outline-info btn-sm' style='margin-right:5px;' href='view.php?view=$row[usr]' ><i class='fas fa-eye fa-s'></i> View</a>";
			echo "<a class='btn btn-outline-success btn-sm' style='margin-right:5px;' href='edit/editGsm.php?edit=$row[Gsm_ID]' ><i class='far fa-edit fa-xs'></i> Edit</a>";
			echo "<a class='btn btn-outline-danger btn-sm' href='delete/delGsm.php?edit=$row[Gsm_ID]' onClick=\"return confirm('Weet je zeker dat je dit item wilt verwijderen?')\"><i class='far fa-trash-alt fa-xs'></i> Delete</a>";
			echo "</td></tr>";
		} ?>
</tbody></table>
</div>
	
<footer>&copy; <b>B | A | S </b> -  <?php
$dt = new DateTime();
echo $dt->format('d-m-Y');
?> - Inventadmin </footer>
</body>
</html>