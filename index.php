<html><head><link rel="icon" sizes="32x32" type="image/png" href="favicon.ico"/><title>Inventadmin</title>
<meta http-equiv="X-UA-Compatible" content="IE=edge;" /><style><?php
error_reporting(E_ALL); ini_set('display_errors', 1);
	include "includes/css/stylehome.css";
	//include "includes/css/popup.css";
?></style><?php
	include "includes/connection.php";
?><link rel="stylesheet" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css">
		  <link href="https://use.fontawesome.com/releases/v5.0.8/css/all.css" rel="stylesheet">
		  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		 <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script> 
		  <script> <?php include "includes/js/my_js.js"; ?> </script>	
		 <script><?php include "includes/js/menuswitch.js"; ?>	</script>
</head><body><?php

	
		echo "<div class='navbar'>";
		echo "<a href='http://webserver03/index/login.php'>Portal</a>";

		echo "<div class='dropdown'>";
		echo "<button class='dropbtn'>Item toevoegen</button>";
		echo "<div class='dropdown-content'>";
		echo "<a href='insert/insertComForm.php'>Computer</a>";
		echo "<a href='insert/insertMonForm.php'>Monitor</a>";
		echo "<a href='insert/insertSoftForm.php'>Software</a>";
		echo "</div>";
		echo "</div>";
		
		echo "<a href='insert/insertUserForm.php'>Gebruiker toevoegen</a>";
		
		echo "<div class='dropdown' style='float:right;'>";
		
		echo "<select id='drop' class='keuze'>";
		echo "<option class='keuze' value='table1' selected>Computer</option>";
		echo "<option class='keuze' value='table2'>Monitor</option>";
		echo "<option class='keuze' value='table3'>Software</option>";
		echo "<option class='keuze' value='table4'>Gebruiker</option>";
		echo "</select>";
		echo "</div>";
		echo "</div>";
		
	echo "<div id='divtable1' class='table' >";
	echo "<table id='table1' class='display compact' cellspacing='0' width='100%'>"; 
		echo "<thead><tr><th>Barcode</th><th>Computernaam</th><th>Ip-adres</th><th>CPU</th><th>RAM</th><th>Moederbord</th><th>Aanschaf datum</th><th></th></tr></thead><tbody>"; 	
		$stmt = $conn->query('SELECT * FROM IA_Computer');
		while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
			$originalDate = $row['Aanschaf_dat'];
			$newDate = date("d-m-Y", strtotime($originalDate));
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
			echo "</td><td>";
			echo $newDate;
			echo "</td><td class='knoppen'>";
			echo "<a class='but_view' href='view.php?view=$row[Com_ID]' ><i class='fas fa-eye fa-xs'></i> View</a>";
			echo "<a class='but_edit' href='edit/editCom.php?edit=$row[Com_ID]' ><i class='far fa-edit fa-xs'></i> Edit</a>";
			echo "<a class='but_del' href='delete/delCom.php?edit=$row[Com_ID]' onClick=\"return confirm('Weet je zeker dat je dit item wilt verwijderen?')\"><i class='far fa-trash-alt fa-xs'></i> Delete</a>";
			echo "</td></tr>";
		}
	echo "</tbody></table>"; 
	echo "</div>";
	
	echo "<div id='divtable2' class='table' >";
	echo "<table id='table2' class='display compact' cellspacing='0' width='100%'>"; 
		echo "<thead><tr><th>Computerbarcode</th><th>Monitorbarcode</th><th>Merk</th><th>Type</th><th>Inch</th><th>Aanschaf datum</th><th>Aanschaf Waarde</th><th></th></tr></thead><tbody>"; 	
		$stmt = $conn->query('SELECT DISTINCT IA_Computer.Barcode AS Bar, Mon_ID, IA_Monitor.Barcode, IA_Monitor.Merk, IA_Monitor.Type, IA_Monitor.Inch, IA_Monitor.Aanschaf_dat, IA_Monitor.Aanschaf_waarde FROM IA_Monitor,IA_Computer WHERE IA_Computer.Com_ID=IA_Monitor.Com_ID');
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
			echo "&euro;"; echo number_format((float)$waarde, 2, '.', '');
			echo "</td><td class='knoppen'>";
			echo "<a class='but_edit' href='edit/editMon.php?edit=$row[Mon_ID]' ><i class='far fa-edit fa-xs'></i> Edit</a>";
			
			echo "<a class='but_del' href='delete/delMon.php?edit=$row[Mon_ID]' onClick=\"return confirm('Weet je zeker dat je dit item wilt verwijderen?')\"><i class='far fa-trash-alt fa-xs'></i> Delete</a>";
			echo "</td></tr>";
		}
echo "</tbody></table>";
	echo "</div>";

	echo "<div id='divtable3' class='table' >";
	echo "<table id='table3' class='display compact' cellspacing='0' width='100%'>"; 
		echo "<thead><tr><th>Computerbarcode</th><th>Softnaam</th><th>Versie</th><th>Aanschaf datum</th><th>Aanschaf Waarde</th><th></th></tr></thead><tbody>"; 	
		$stmt = $conn->query('SELECT *, IA_Software_RG.Soft_ID as rid FROM IA_Software, IA_Computer, IA_Software_RG WHERE IA_Computer.Com_ID=IA_Software_RG.Com_ID AND IA_Software.Soft_ID=IA_Software_RG.Soft_ID');
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
			echo "&euro;"; echo number_format((float)$waarde, 2, '.', '');
			echo "</td><td class='knoppen'>";
			echo "<a class='but_edit' href='edit/editSoft.php?edit=$row[rid]' ><i class='far fa-edit fa-xs'></i> Edit</a>";
			
			echo "<a class='but_del' href='delete/delSoft.php?edit=$row[rid]' onClick=\"return confirm('Weet je zeker dat je dit item wilt verwijderen?')\"><i class='far fa-trash-alt fa-xs'></i> Delete</a>";
			echo "</td></tr>";
		}
echo "</tbody></table>";
	echo "</div>";


	echo "<div id='divtable4' class='table' >";
	echo "<table id='table4' class='display compact' cellspacing='0' width='100%'>"; 
		echo "<thead><tr><th>Computerbarcode</th><th>Locatie</th><th>Gebruikersnaam</th><th>E-mail</th><th></th></tr></thead><tbody>"; 	
		$stmt = $conn->query('SELECT IA_Gebruiker.U_ID as usr, Barcode, Ruimte_naam, Gebruiker, Mailadres FROM IA_Computer, IA_Gebruiker, IA_Locatie WHERE IA_Locatie.Ruimte_ID=IA_Gebruiker.Ruimte_ID AND IA_Computer.Com_ID=IA_Gebruiker.Com_ID');
		while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
			echo "<tr><td>";
			echo $row['Barcode'];
			echo "</td><td>";
			echo strip_tags($row['Ruimte_naam']);
			echo "</td><td>";
			echo strip_tags($row['Gebruiker']);
			echo "</td><td>";
			echo strip_tags($row['Mailadres']);
			echo "</td><td class='knoppen'>";
			echo "<a class='but_edit' href='edit/editUser.php?edit=$row[usr]' ><i class='far fa-edit fa-xs'></i> Edit</a>";
			
			echo "<a class='but_del' href='delete/delUser.php?edit=$row[usr]' onClick=\"return confirm('Weet je zeker dat je dit item wilt verwijderen?')\"><i class='far fa-trash-alt fa-xs'></i> Delete</a>";
			echo "</td></tr>";
		}
echo "</tbody></table>";
echo "</div>";
	?>
<footer>&copy; <b>B | A | S </b> -  <?php
$dt = new DateTime();
echo $dt->format('d-m-Y');
?> - Inventadmin </footer>

