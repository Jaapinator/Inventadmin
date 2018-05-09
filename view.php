<html><head><link rel="icon" sizes="32x32" type="image/png" href="favicon.ico"/><title>Inventadmin</title>
<meta http-equiv="X-UA-Compatible" content="IE=edge;" /><?php
	include "includes/connection.php";
	include "includes/scripts.php";
?></head><body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top">
	<a class="navbar-brand" href="https://portal.basrt.eu/">Inventadmin</a>
	<div class="collapse navbar-collapse" id="navbarNavDropdown">
		<ul class="navbar-nav">
			<li class="nav-item">
				<a class="nav-link" href='index.php'>Overzicht</a>
			</li>
		</ul>
	</div>
</nav>
	<?php
	$id = $_GET['view'];
	$sql = "SELECT * FROM IA_Computer WHERE Com_ID = :id";
	$query = $conn->prepare($sql);
	$query->execute(array(':id' => $id));
	while($row = $query->fetch(PDO::FETCH_ASSOC)){
		$com_barcode = $row['Barcode'];
		$com_naam = $row['Com_naam'];
		$ip = $row['Ip_adres'];
		$com_merk = $row['Com_merk'];
		$com_cpu = $row['CPU_naam'];
		$com_mem = $row['Memory'];
		$com_moed = $row['Moederbord'];
		$com_serial = $row['Serialnummer'];
		$com_a_dat = $row['Aanschaf_dat'];
		$com_a_prijs = $row['Aanschaf_waarde']; 
		$comm = $row['Opmerkingen'];
	}
	echo "<H2>". $com_naam ."</H2>";
?>

<?php
	$comnewDate = date("d-m-Y", strtotime($com_a_dat));
?>
<table>
<tr><td>Computerbarcode: </td><td><?php echo $com_barcode;?></td></tr>
<tr><td>Computernaam: </td><td><?php echo $com_naam;?></td></tr>
<tr><td>Ip-adres: </td><td><?php echo $ip;?></td></tr>
<tr><td>Computermerk: </td><td><?php echo $com_merk;?></td></tr>
<tr><td>Processor: </td><td><?php echo $com_cpu;?></td></tr>
<tr><td>Ram geheugen: </td><td><?php echo $com_mem;?></td></tr>
<tr><td>Moederbord: </td><td><?php echo $com_moed;?></td></tr>
<tr><td>Serialnummer: </td><td><?php echo $com_serial;?></td></tr>
<tr><td>Aanschaf datum: </td><td><?php echo $comnewDate;?></td></tr>
<tr><td>Aanschaf waarde: </td><td><?php echo "&euro; ".number_format((float)$com_a_prijs, 2, '.', '')."";?></td></tr>
</table>
<br>
<?php
$sql = "SELECT * FROM IA_Monitor WHERE Com_ID = :id";
$query = $conn->prepare($sql);
$query->execute(array(':id' => $id));
$rows = $query->fetchAll(PDO::FETCH_ASSOC);

$value = count($rows);
if ($value != 0)
foreach($rows as $row){
    $monnewDate = date("d-m-Y", strtotime($row['Aanschaf_dat']));
    ?>
    <table style="display:inline-block;float:left;">
        <tr><td>Monitorbarcode: </td><td><?php echo $row['Barcode'];?></td></tr>
        <tr><td>Merk: </td><td><?php echo $row['Merk'];?></td></tr>
        <tr><td>Type: </td><td><?php echo $row['Type'];?></td></tr>
        <tr><td>Inch: </td><td><?php echo $row['Inch'];?></td></tr>
        <tr><td>Aanschaf datum: </td><td><?php echo $monnewDate; ?></td></tr>
        <tr><td>Aanschaf waarde: </td><td><?php echo "&euro; ".number_format((float)$row['Aanschaf_waarde'], 2, '.', '')."";?></td></tr>
	</table>	
<?php
}else{
    echo "<i>Geen monitoren gevonden</i>";
}
?>
<br>
<?php
$sql = "SELECT * FROM IA_Software, IA_Software_RG WHERE Com_ID = :id AND IA_Software.Soft_ID=IA_Software_RG.Soft_ID";
$query = $conn->prepare($sql);
$query->execute(array(':id' => $id));
$rows = $query->fetchAll(PDO::FETCH_ASSOC);

$value = count($rows);
if ($value != 0)
foreach($rows as $row){
    $monnewDate = date("d-m-Y", strtotime($row['Aanschaf_dat']));
    ?>
    <table style="display:inline-block;float:left;">
        <tr><td>Programma: </td><td><?php echo $row['Soft_naam'];?></td></tr>
        <tr><td>Versie: </td><td><?php echo $row['Versie'];?></td></tr>
        <tr><td>Aanschaf datum: </td><td><?php echo $monnewDate; ?></td></tr>
        <tr><td>Aanschaf waarde: </td><td><?php echo "&euro; ".number_format((float)$row['Aanschaf_waarde'], 2, '.', '')."";?></td></tr>
    </table>
	
    <?php
}else{
    echo "<i>Geen software gevonden</i>";
}
?>
<br>
  <?php
  $sql = "SELECT * FROM IA_Gebruiker, IA_Locatie, IA_Locatie_RG WHERE Com_ID = :id AND IA_Locatie_RG.U_ID=IA_Gebruiker.U_ID AND IA_Locatie.Ruimte_ID=IA_Locatie_RG.Ruimte_ID";
  $query = $conn->prepare($sql);
  $query->execute(array(':id' => $id));
  $rows = $query->fetchAll(PDO::FETCH_ASSOC);
  
$value = count($rows);
if ($value !=0){
foreach($rows as $row){
	?>
	<table>
	<tr><td>Naam: </td><td><?php echo $row['Gebruiker'];?></td></tr>
	<tr><td>E-mail: </td><td><?php echo $row['Mailadres'];?></td></tr>
	<tr><td>Locatie: </td><td><?php echo $row['Ruimte_naam'];?></td></tr>
	</table>
	<?php
}}else{
	echo "<i>Geen gebruiker gevonden</i>";
}
?>
<br>
<?php
  $sql = "SELECT * FROM IA_Randapparatuur WHERE Com_ID = :id";
  $query = $conn->prepare($sql);
  $query->execute(array(':id' => $id));
  $rows = $query->fetchAll(PDO::FETCH_ASSOC);
  
$value = count($rows);
if ($value !=0)
foreach($rows as $row){
	$randnewDate = date("d-m-Y", strtotime($row['Aanschaf_dat']));
	?>
	<table style="display:inline-block;float:left;">
	<tr><td>Merk: </td><td><?php echo $row['Merk'];?></td></tr>
	<tr><td>Type: </td><td><?php echo $row['Type'];?></td></tr>
	<tr><td>Aanschaf datum: </td><td><?php echo $randnewDate;?></td></tr>
	<tr><td>Aanschaf waarde: </td><td><?php echo "&euro; ".number_format((float)$row['Aanschaf_waarde'], 2, '.', '')."";?></td></tr>
	</table>
	<?php
}else{
	echo "<i>Geen randapparatuur gevonden</i>";
}
  ?><br>
  <div class="comm">
    <label>Voeg opmerkingen toe</label><br>
	<form id="comment" action="edit/updateOpmerk.php" method="post">
	<textarea name="comment"><?php echo $comm;?></textarea><br>
	<input type="hidden" name="view" value="<?php echo $id;?>"/>
	<input type="submit" value="Edit" name="submit" />
	</form>
  </div>
</body>
</html>