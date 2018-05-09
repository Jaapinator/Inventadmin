<html><head><link rel="icon" sizes="32x32" type="image/png" href="favicon.ico"/><title>Inventadmin</title>
<meta http-equiv="X-UA-Compatible" content="IE=edge;" /><meta name="format-detection" content="telephone=no">
<?php
error_reporting(E_ALL); ini_set('display_errors', 1);
	include "includes/connection.php";
	include "includes/scripts.php";
?><script><?php include "includes/js/menuswitch.js"; ?> </script>		
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
				    <a class="dropdown-item" href='insert/insertComForm.php'>Computer</a>
					<a class="dropdown-item" href='insert/insertMonForm.php'>Monitor</a>
					<a class="dropdown-item" href='insert/insertSoftForm.php'>Software</a>
					<a class="dropdown-item" href='insert/insertRandForm.php'>Randapparatuur</a>
					<a class="dropdown-item" href='insert/insertGsmForm.php'>Telefoon</a>
					<a class="dropdown-item" href='insert/insertTabForm.php'>Tablet</a>
					<a class="dropdown-item" href='insert/insertLapForm.php'>Laptop</a>
				</div>
			  </li>
			  <li class="nav-item">
				<a class="nav-link" href='insert/bound.php'>Computer koppelen</a>
			  </li>
			  <li class="nav-item">
				<a class="nav-link" href='insert/insertUserForm.php'>Gebruiker toevoegen</a>
			  </li>
			 
	
		<select id='drop' class='keuze' style="float:right;">
		<option class='keuze' value='table1' selected>Computer</option>
		<option class='keuze' value='table2'>Monitor</option>
		<option class='keuze' value='table3'>Software</option>
		<option class='keuze' value='table4'>Gebruiker</option>
		<option class='keuze' value='table5'>Randapparatuur</option>
		<option class='keuze' value='table6'>Telefoon</option>
		<option class='keuze' value='table7'>Tablet</option>
		<option class='keuze' value='table8'>Laptop</option>
		</select>
		
		</ul>
	</div>
</nav>
		
<div id='divtable1' class='table' >
	<table id='table1' class='table table-striped table-bordered' cellspacing='0' width='100%'> 
		<thead><tr><th>Barcode</th><th>Computernaam</th><th>Ip-adres</th><th>CPU</th><th>RAM</th><th>Moederbord</th><th>Aanschaf datum</th><th></th></tr></thead><tbody>
		<?php $stmt = $conn->query('SELECT * FROM IA_Computer ORDER BY Barcode');
		while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
			$newDate = date("d-m-Y", strtotime($row['Aanschaf_dat']));
			echo "<tr><td>";
			echo $row['Barcode'];
			echo "</td><td>";
			echo strip_tags($row['Com_naam']);
			echo "</td><td>";
			echo strip_tags($row['Ip_adres']);
			echo "</td><td>";
			echo strip_tags($row['CPU_naam']);
			echo "</td><td>";
			echo strip_tags($row['Memory']);
			echo "</td><td>";
			echo strip_tags($row['Moederbord']);
			echo "</td><td >";
			echo $row['Aanschaf_dat']; ?>
			</td><td class='knoppen'><?php
			echo "<a class='btn btn-outline-info btn-sm' style='margin-right:5px;' href='view.php?view=$row[Com_ID]' ><i class='fas fa-eye fa-s'></i> View</a>";
			echo "<a class='btn btn-outline-success btn-sm' style='margin-right:5px;' href='edit/editCom.php?edit=$row[Com_ID]' ><i class='far fa-edit fa-s'></i> Edit</a>";
			echo "<a class='btn btn-outline-danger btn-sm' href='delete/delCom.php?edit=$row[Com_ID]' onClick=\"return confirm('Weet je zeker dat je dit item wilt verwijderen?')\"><i class='far fa-trash-alt fa-s'></i> Delete</a>
			</td></tr>";
	 	} ?>
	</tbody></table>
</div>

<div id='divtable2' class='table' >
	<table id='table2' class='table table-striped table-bordered' cellspacing='0' width='100%'>
		<thead><tr><th>Computerbarcode</th><th>Monitorbarcode</th><th>Merk</th><th>Type</th><th>Inch</th><th>Aanschaf datum</th><th>Aanschaf Waarde</th><th></th></tr></thead><tbody>	
	<?php $stmt = $conn->query('SELECT *, (SELECT Barcode FROM IA_Computer WHERE IA_Computer.Com_ID=IA_Monitor.Com_ID) as bar FROM IA_Monitor');
		while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
			$waarde = $row['Aanschaf_waarde'];
			$originalDate = $row['Aanschaf_dat'];
			$newDate = date("d-m-Y", strtotime($originalDate));
			echo "<tr><td>";
			if($row['Com_ID'] == NULL) { echo "Geen computer"; } else { echo $row['bar']; }
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
			if($row['Com_ID'] == NULL) {  } else { echo "<a class='btn btn-outline-info btn-sm' style='margin-right:5px;' href='view.php?view=$row[Com_ID]' ><i class='fas fa-eye fa-s'></i> View</a>"; }
			echo "<a class='btn btn-outline-success btn-sm' style='margin-right:5px;' href='edit/editMon.php?edit=$row[Mon_ID]' ><i class='far fa-edit fa-s'></i> Edit</a>";			
			echo "<a class='btn btn-outline-danger btn-sm' href='delete/delMon.php?edit=$row[Mon_ID]' onClick=\"return confirm('Weet je zeker dat je dit item wilt verwijderen?')\"><i class='far fa-trash-alt fa-s'></i> Delete</a>";
			echo "</td></tr>";
		} ?>
</tbody></table>
	</div>

	<div id='divtable3' class='table' >
	<table id='table3' class='table table-striped table-bordered' cellspacing='0' width='100%'> 
		<thead><tr><th>Computerbarcode</th><th>Softnaam</th><th>Versie</th><th>Aanschaf datum</th><th>Aanschaf Waarde</th><th></th></tr></thead><tbody>	
	<?php $stmt = $conn->query('SELECT *, IA_Software_RG.Soft_ID as rid, IA_Computer.Com_ID AS comid FROM IA_Software, IA_Computer, IA_Software_RG WHERE IA_Computer.Com_ID=IA_Software_RG.Com_ID AND IA_Software.Soft_ID=IA_Software_RG.Soft_ID');
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
			echo "<a class='btn btn-outline-info btn-sm' style='margin-right:5px;' href='view.php?view=$row[comid]' ><i class='fas fa-eye fa-s'></i> View</a>";
			echo "<a class='btn btn-outline-success btn-sm' style='margin-right:5px;' href='edit/editSoft.php?edit=$row[rid]' ><i class='far fa-edit fa-xs'></i> Edit</a>";
			echo "<a class='btn btn-outline-danger btn-sm' href='delete/delSoft.php?edit=$row[rid]' onClick=\"return confirm('Weet je zeker dat je dit item wilt verwijderen?')\"><i class='far fa-trash-alt fa-xs'></i> Delete</a>";
			echo "</td></tr>";
		} ?>
</tbody></table>
	</div>


	<div id='divtable4' class='table' >
	<table id='table4' class='table table-striped table-bordered' cellspacing='0' width='100%'>
		<thead><tr><th>Computerbarcode</th><th>Ip-adres</th><th>Locatie</th><th>Gebruikersnaam</th><th>E-mail</th><th></th></tr></thead><tbody>
		<?php $stmt = $conn->query('SELECT IA_Gebruiker.U_ID as usr, IA_Computer.Com_ID AS comid, Barcode, Ruimte_naam, Gebruiker, Mailadres, Ip_adres FROM IA_Computer, IA_Gebruiker, IA_Locatie, IA_Locatie_RG WHERE IA_Locatie.Ruimte_ID=IA_Locatie_RG.Ruimte_ID AND IA_Computer.Com_ID=IA_Locatie_RG.Com_ID AND IA_Gebruiker.U_ID=IA_Locatie_RG.U_ID');
		while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
			echo "<tr><td>";
			echo $row['Barcode'];
			echo "</td><td>";
			echo strip_tags($row['Ip_adres']);
			echo "</td><td>";
			echo strip_tags($row['Ruimte_naam']);
			echo "</td><td>";
			echo strip_tags($row['Gebruiker']);
			echo "</td><td>";
			echo strip_tags($row['Mailadres']); ?>
			</td><td class='knoppen'> <?php
			echo "<a class='btn btn-outline-info btn-sm' style='margin-right:5px;' href='view.php?view=$row[comid]' ><i class='fas fa-eye fa-s'></i> View</a>";
			echo "<a class='btn btn-outline-success btn-sm' style='margin-right:5px;' href='edit/editUser.php?edit=$row[usr]' ><i class='far fa-edit fa-s'></i> Edit</a>";
			echo "<a class='btn btn-outline-danger btn-sm' href='delete/delUser.php?edit=$row[usr]' onClick=\"return confirm('Weet je zeker dat je dit item wilt verwijderen?')\"><i class='far fa-trash-alt fa-s'></i> Delete</a>";
			echo "</td></tr>";
		} ?>
</tbody></table>
</div>

	<div id='divtable5' class='table' >
	<table id='table5' class='table table-striped table-bordered' cellspacing='0' width='100%'>
		<thead><tr><th>Computerbarcode</th><th>Merk</th><th>Type</th><th>Aanschaf datum</th><th>Aanschaf waarde</th><th></th></tr></thead><tbody> 	
	<?php	$stmt = $conn->query('SELECT IA_Computer.Barcode, IA_Randapparatuur.Merk, IA_Randapparatuur.Type, IA_Randapparatuur.Aanschaf_waarde, IA_Randapparatuur.Aanschaf_dat, Rand_ID FROM IA_Randapparatuur, IA_Computer WHERE IA_Randapparatuur.Com_ID=IA_Computer.Com_ID');
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
	<?php	$stmt = $conn->query('SELECT Gsm_ID, Gebruiker, Telefoonnummer, Merk, Model, Aanschaf_dat, Aanschaf_waarde FROM IA_Gebruiker, IA_Telefoon WHERE IA_Gebruiker.U_ID=IA_Telefoon.U_ID');
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
			echo "<a class='btn btn-outline-success btn-sm' style='margin-right:5px;' href='edit/editGsm.php?edit=$row[Gsm_ID]' ><i class='far fa-edit fa-xs'></i> Edit</a>";
			
			echo "<a class='btn btn-outline-danger btn-sm' href='delete/delGsm.php?edit=$row[Gsm_ID]' onClick=\"return confirm('Weet je zeker dat je dit item wilt verwijderen?')\"><i class='far fa-trash-alt fa-xs'></i> Delete</a>";
			echo "</td></tr>";
		} ?>
</tbody></table>
</div>

<div id='divtable7' class='table' >
	<table id='table7' class='table table-striped table-bordered' cellspacing='0' width='100%'>
		<thead><tr><th>Gebruiker</th><th>Merk</th><th>Model</th><th>Inch</th><th>Opslagcapaciteit</th><th>Aanschaf datum</th><th>Aanschaf waarde</th><th></th></tr></thead><tbody> 	
	<?php	$stmt = $conn->query('SELECT * FROM IA_Gebruiker, IA_Tablet WHERE IA_Gebruiker.U_ID=IA_Tablet.U_ID');
		while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
			$newDate = date("d-m-Y", strtotime($row['Aanschaf_dat']));
			echo "<tr><td>";
			echo strip_tags($row['Gebruiker']);
			echo "</td><td>";
			echo strip_tags($row['Merk']);
			echo "</td><td>";
			echo strip_tags($row['Model']);
			echo "</td><td>";
			echo strip_tags($row['Inch']);
			echo "</td><td>";
			echo strip_tags($row['Opslagcapaciteit']);
			echo "</td><td>";
			echo $newDate;
			echo "</td><td>";
			echo "&euro;"; echo number_format((float)$row['Aanschaf_waarde'], 2, '.', ''); ?>
			</td><td class='knoppen'> <?php
			echo "<a class='btn btn-outline-success btn-sm' style='margin-right:5px;' href='edit/editTab.php?edit=$row[Tab_ID]' ><i class='far fa-edit fa-xs'></i> Edit</a>";
			
			echo "<a class='btn btn-outline-danger btn-sm' href='delete/delTab.php?edit=$row[Tab_ID]' onClick=\"return confirm('Weet je zeker dat je dit item wilt verwijderen?')\"><i class='far fa-trash-alt fa-xs'></i> Delete</a>";
			echo "</td></tr>";
		} ?>
</tbody></table>
</div>
<div id='divtable8' class='table' >
	<table id='table8' class='table table-striped table-bordered' cellspacing='0' width='100%'>
		<thead><tr><th>Gebruiker</th><th>Barcode</th><th>Merk</th><th>CPU</th><th>Memory</th><th>Inch</th><th>Aanschaf datum</th><th>Aanschaf waarde</th><th></th></tr></thead><tbody> 	
	<?php	$stmt = $conn->query('SELECT * FROM IA_Gebruiker, IA_Laptop WHERE IA_Gebruiker.U_ID=IA_Laptop.U_ID');
		while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
			$newDate = date("d-m-Y", strtotime($row['Aanschaf_dat']));
			echo "<tr><td>";
			echo strip_tags($row['Gebruiker']);
			echo "</td><td>";
			echo strip_tags($row['Barcode']);
			echo "</td><td>";
			echo strip_tags($row['Merk']);
			echo "</td><td>";
			echo strip_tags($row['CPU']);
			echo "</td><td>";
			echo strip_tags($row['Memory']);
			echo "</td><td>";
			echo strip_tags($row['Inch']);
			echo "</td><td>";
			echo $newDate;
			echo "</td><td>";
			echo "&euro;"; echo number_format((float)$row['Aanschaf_waarde'], 2, '.', ''); ?>
			</td><td class='knoppen'> <?php
			echo "<a class='btn btn-outline-success btn-sm' style='margin-right:5px;' href='edit/editLap.php?edit=$row[Lap_ID]' ><i class='far fa-edit fa-xs'></i> Edit</a>";
			
			echo "<a class='btn btn-outline-danger btn-sm' href='delete/delLap.php?edit=$row[Lap_ID]' onClick=\"return confirm('Weet je zeker dat je dit item wilt verwijderen?')\"><i class='far fa-trash-alt fa-xs'></i> Delete</a>";
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