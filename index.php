<html><head><link rel="icon" sizes="32x32" type="image/png" href="favicon.ico"/><title>Inventadmin</title>
<meta http-equiv="X-UA-Compatible" content="IE=edge;" /><meta name="format-detection" content="telephone=no">
<style><?php
error_reporting(E_ALL); ini_set('display_errors', 1);
	include "includes/css/stylehome.css";
?></style><?php
$useragent=$_SERVER['HTTP_USER_AGENT'];
if(preg_match('/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od|ad)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows ce|xda|xiino/i',$useragent)||preg_match('/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i',substr($useragent,0,4)))
header('Location: indexmobile.php');
	include "includes/connection.php";
?><link rel="stylesheet" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css">
		  <link href="https://use.fontawesome.com/releases/v5.0.8/css/all.css" rel="stylesheet">
		  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		 <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>  
		 <script src="//cdn.datatables.net/plug-ins/1.10.16/sorting/date-uk.js"></script>
		 <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.1/moment.min.js"></script>
		  <script> <?php include "includes/js/my_js.js"; ?> </script>	
		 <script><?php include "includes/js/menuswitch.js"; ?>	</script>
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
			echo strip_tags($row['Serialnum']);
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
			if($row['Com_ID'] == NULL) {  } else { echo "<a class='but_view' href='view.php?view=$row[Com_ID]' ><i class='fas fa-eye fa-s'></i> View</a>"; }
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
