<html><head><link rel="icon" sizes="32x32" type="image/png" href="favicon.ico"/><title>Inventadmin</title>
<meta http-equiv="X-UA-Compatible" content="IE=edge;" />
<style><?php
error_reporting(E_ALL); ini_set('display_errors', 1);
	include "includes/css/stylehome.css";
?></style><?php
	include "includes/connection.php";
?><link rel="stylesheet" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css">
		  <link href="https://use.fontawesome.com/releases/v5.0.8/css/all.css" rel="stylesheet">
		  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		 <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>  
		 <script src="//cdn.datatables.net/plug-ins/1.10.16/sorting/date-uk.js"></script>
		 <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.1/moment.min.js"></script>
		  <script> <?php include "includes/js/my_js.js"; ?> </script>	
		 <script><?php include "includes/js/menuswitch.js"; ?>	</script>
		 <script><?php include "includes/js/scanner.js"; ?> </script> 
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <script type="text/javascript" src="includes/js/quagga.min.js"></script>

  <script>
  $( function() {
    $( "#modal" ).dialog({
      autoOpen: false
    });
 
    $( "#opener" ).on( "click", function() {
      $( "#modal" ).dialog( "open" );
    });
  } );
  </script>
		 </head>
<body>
		<div class='navbar'>
		<a href='https://portal.basrt.eu/'>Portal</a>
		
		<div class='dropdown'>
		<button class='dropbtn'>Item toevoegen</button>
		<div class='dropdown-content'>
		<a href='insert/insertComForm.php'>Computer</a>
		<a href='insert/insertMonForm.php'>Monitor</a>
		<a href='insert/insertSoftForm.php'>Software</a>
		<a href='insert/insertRandForm.php'>Randapparatuur</a>
		<a href='insert/insertGsmForm.php'>Telefoon</a>
		<a href='insert/insertTabForm.php'>Tablet</a>
		<a href='insert/insertLapForm.php'>Laptop</a>
		</div>
		</div>
		
		<a href='insert/insertUserForm.php'>Gebruiker toevoegen</a>
		<a href='insert/bound.php'>Computer koppelen</a>
		<a id="opener">Barcode scanner</a>
		<div class='dropdown' style='float:right;'>
	
		<select id='drop' class='keuze'>
		<option class='keuze' value='table1' selected>Computer</option>
		<option class='keuze' value='table2'>Monitor</option>
		<option class='keuze' value='table3'>Software</option>
		<option class='keuze' value='table4'>Gebruiker</option>
		<option class='keuze' value='table5'>Randapparatuur</option>
		<option class='keuze' value='table6'>Telefoon</option>
		<option class='keuze' value='table7'>Tablet</option>
		<option class='keuze' value='table8'>Laptop</option>
		</select>
		</div>
		</div>

<div id="modal" title="Barcode scanner">
	<span class="found"></span>
	<div id="interactive" class="viewport"></div>
</div>
		
	<div id='divtable1' class='table' >
	<table id='table1' class='display compact' cellspacing='0' width='100%'> 
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
			echo "<a class='but_view' href='view.php?view=$row[Com_ID]' ><i class='fas fa-eye fa-s'></i> View</a>";
			echo "<a class='but_edit' href='edit/editCom.php?edit=$row[Com_ID]' ><i class='far fa-edit fa-s'></i> Edit</a>";
			echo "<a class='but_del' href='delete/delCom.php?edit=$row[Com_ID]' onClick=\"return confirm('Weet je zeker dat je dit item wilt verwijderen?')\"><i class='far fa-trash-alt fa-s'></i> Delete</a>
			</td></tr>";
	 	} ?>
	</tbody></table>
	</div>
	
	<div id='divtable2' class='table' >
	<table id='table2' class='display compact' cellspacing='0' width='100%'>
		<thead><tr><th>Computerbarcode</th><th>Monitorbarcode</th><th>Merk</th><th>Type</th><th>Inch</th><th>Aanschaf datum</th><th>Aanschaf Waarde</th><th></th></tr></thead><tbody>	
	<?php $stmt = $conn->query('SELECT DISTINCT IA_Computer.Barcode AS Bar, IA_Computer.Com_ID AS comid, Mon_ID, IA_Monitor.Barcode, IA_Monitor.Merk, IA_Monitor.Type, IA_Monitor.Inch, IA_Monitor.Aanschaf_dat, IA_Monitor.Aanschaf_waarde FROM IA_Monitor,IA_Computer WHERE IA_Computer.Com_ID=IA_Monitor.Com_ID');
		while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
			$waarde = $row['Aanschaf_waarde'];
			$originalDate = $row['Aanschaf_dat'];
			$newDate = date("d-m-Y", strtotime($originalDate));
			echo "<tr><td>";
			echo $row['Bar'];
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
			echo "<a class='but_view' href='view.php?view=$row[comid]' ><i class='fas fa-eye fa-s'></i> View</a>";
			echo "<a class='but_edit' href='edit/editMon.php?edit=$row[Mon_ID]' ><i class='far fa-edit fa-s'></i> Edit</a>";			
			echo "<a class='but_del' href='delete/delMon.php?edit=$row[Mon_ID]' onClick=\"return confirm('Weet je zeker dat je dit item wilt verwijderen?')\"><i class='far fa-trash-alt fa-s'></i> Delete</a>";
			echo "</td></tr>";
		} ?>
</tbody></table>
	</div>

	<div id='divtable3' class='table' >
	<table id='table3' class='display compact' cellspacing='0' width='100%'> 
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
			echo "<a class='but_view' href='view.php?view=$row[comid]' ><i class='fas fa-eye fa-s'></i> View</a>";
			echo "<a class='but_edit' href='edit/editSoft.php?edit=$row[rid]' ><i class='far fa-edit fa-xs'></i> Edit</a>";
			echo "<a class='but_del' href='delete/delSoft.php?edit=$row[rid]' onClick=\"return confirm('Weet je zeker dat je dit item wilt verwijderen?')\"><i class='far fa-trash-alt fa-xs'></i> Delete</a>";
			echo "</td></tr>";
		} ?>
</tbody></table>
	</div>


	<div id='divtable4' class='table' >
	<table id='table4' class='display compact' cellspacing='0' width='100%'>
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
			echo "<a class='but_view' href='view.php?view=$row[comid]' ><i class='fas fa-eye fa-s'></i> View</a>";
			echo "<a class='but_edit' href='edit/editUser.php?edit=$row[usr]' ><i class='far fa-edit fa-s'></i> Edit</a>";
			echo "<a class='but_del' href='delete/delUser.php?edit=$row[usr]' onClick=\"return confirm('Weet je zeker dat je dit item wilt verwijderen?')\"><i class='far fa-trash-alt fa-s'></i> Delete</a>";
			echo "</td></tr>";
		} ?>
</tbody></table>
</div>

	<div id='divtable5' class='table' >
	<table id='table5' class='display compact' cellspacing='0' width='100%'>
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
			echo "<a class='but_edit' href='edit/editRand.php?edit=$row[Rand_ID]' ><i class='far fa-edit fa-xs'></i> Edit</a>";
			
			echo "<a class='but_del' href='delete/delRand.php?edit=$row[Rand_ID]' onClick=\"return confirm('Weet je zeker dat je dit item wilt verwijderen?')\"><i class='far fa-trash-alt fa-xs'></i> Delete</a>";
			echo "</td></tr>";
		} ?>
</tbody></table>
</div>

	<div id='divtable6' class='table' >
	<table id='table6' class='display compact' cellspacing='0' width='100%'>
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
			echo "<a class='but_edit' href='edit/editGsm.php?edit=$row[Gsm_ID]' ><i class='far fa-edit fa-xs'></i> Edit</a>";
			
			echo "<a class='but_del' href='delete/delGsm.php?edit=$row[Gsm_ID]' onClick=\"return confirm('Weet je zeker dat je dit item wilt verwijderen?')\"><i class='far fa-trash-alt fa-xs'></i> Delete</a>";
			echo "</td></tr>";
		} ?>
</tbody></table>
</div>

<div id='divtable7' class='table' >
	<table id='table7' class='display compact' cellspacing='0' width='100%'>
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
			echo "<a class='but_edit' href='edit/editTab.php?edit=$row[Tab_ID]' ><i class='far fa-edit fa-xs'></i> Edit</a>";
			
			echo "<a class='but_del' href='delete/delTab.php?edit=$row[Tab_ID]' onClick=\"return confirm('Weet je zeker dat je dit item wilt verwijderen?')\"><i class='far fa-trash-alt fa-xs'></i> Delete</a>";
			echo "</td></tr>";
		} ?>
</tbody></table>
</div>
<div id='divtable8' class='table' >
	<table id='table8' class='display compact' cellspacing='0' width='100%'>
		<thead><tr><th>Gebruiker</th><th>Merk</th><th>CPU</th><th>Memory</th><th>Inch</th><th>Aanschaf datum</th><th>Aanschaf waarde</th><th></th></tr></thead><tbody> 	
	<?php	$stmt = $conn->query('SELECT * FROM IA_Gebruiker, IA_Laptop WHERE IA_Gebruiker.U_ID=IA_Laptop.U_ID');
		while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
			$newDate = date("d-m-Y", strtotime($row['Aanschaf_dat']));
			echo "<tr><td>";
			echo strip_tags($row['Gebruiker']);
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
			echo "<a class='but_edit' href='edit/editLap.php?edit=$row[Lap_ID]' ><i class='far fa-edit fa-xs'></i> Edit</a>";
			
			echo "<a class='but_del' href='delete/delLap.php?edit=$row[Lap_ID]' onClick=\"return confirm('Weet je zeker dat je dit item wilt verwijderen?')\"><i class='far fa-trash-alt fa-xs'></i> Delete</a>";
			echo "</td></tr>";
		} ?>
</tbody></table>
</div>
<footer>&copy; <b>B | A | S </b> -  <?php
$dt = new DateTime();
echo $dt->format('d-m-Y');
?> - Inventadmin </footer>
