<html><head><link rel="icon" sizes="32x32" type="image/png" href="favicon.ico"/>
<meta http-equiv="X-UA-Compatible" content="IE=edge;" /><?php
	include "includes/connection.php";
	include "includes/scripts.php";
?><style>
.card:first-of-type{
	border-bottom: 25px;
}
</style></head><body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top">
	<a class="navbar-brand" href="https://portal.basrt.eu/">Inventadmin</a>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
	
	<div class="collapse navbar-collapse" id="navbarNavDropdown">
		<ul class="navbar-nav mr-auto">
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
?>
<title><?php echo $com_naam; ?></title>
<?php
	$comnewDate = date("d-m-Y", strtotime($com_a_dat));
?>
<div class="card-group">
<div class="card bg-light mb-3" style="max-width: 18rem;">
  <div class="card-header">Computer</div>
  <div class="card-body">
    <h5 class="card-title"><?php echo $com_naam; ?></h5>
    <p class="card-text"><table>
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
	</p>
  </div>
</div>
<div class="card bg-light mb-3" style="max-width: 18rem;">
  <div class="card-header">asdf</div>
  <div class="card-body">
    <h5 class="card-title">Gebruiker</h5>
  <?php
  $sql = "SELECT * FROM IA_Gebruiker, IA_Locatie, IA_Locatie_RG WHERE Com_ID = :id AND IA_Locatie_RG.U_ID=IA_Gebruiker.U_ID AND IA_Locatie.Ruimte_ID=IA_Locatie_RG.Ruimte_ID";
  $query = $conn->prepare($sql);
  $query->execute(array(':id' => $id));
  $rows = $query->fetchAll(PDO::FETCH_ASSOC);
  
$value = count($rows);
if ($value !=0){
foreach($rows as $row){
	?>
	<p class="card-text"><table>
	<tr><td>Naam: </td><td><?php echo $row['Gebruiker'];?></td></tr>
	<tr><td>E-mail: </td><td><?php echo $row['Mailadres'];?></td></tr>
	<tr><td>Locatie: </td><td><?php echo $row['Ruimte_naam'];?></td></tr>
	</table></p>
	<?php
}}else{
	echo "<i>Geen gebruiker gevonden</i>";
}
?>
  </div>
</div>
<div class="card bg-light mb-3" style="max-width: 18rem;">
  <div class="card-header">asdf</div>
  <div class="card-body">
    <h5 class="card-title">Telefoon</h5>
  <?php
  $sql = "SELECT * FROM IA_Gebruiker, IA_Telefoon, IA_Locatie_RG WHERE Com_ID = :id AND IA_Locatie_RG.U_ID=IA_Gebruiker.U_ID AND IA_Gebruiker.U_ID=IA_Telefoon.U_ID";
  $query = $conn->prepare($sql);
  $query->execute(array(':id' => $id));
  $rows = $query->fetchAll(PDO::FETCH_ASSOC);
  
$value = count($rows);
if ($value !=0){
foreach($rows as $row){
	?>
	<p class="card-text"><table>
	<tr><td>Telefoonnummer: </td><td><?php echo $row['Telefoonnummer'];?></td></tr>
	<tr><td>Merk: </td><td><?php echo $row['Merk'];?></td></tr>
	<tr><td>Model: </td><td><?php echo $row['Model'];?></td></tr>
	<tr><td>Serialnummer: </td><td><?php echo $row['Serialnummer'];?></td></tr>
	<tr><td>IMEI-nummer: </td><td><?php echo $row['IMEI_nummer_required'];?></td></tr>
	<tr><td>IMEI-nummer: </td><td><?php echo $row['IMEI_nummer_optionel'];?></td></tr>
	<tr><td>Aanschaf datum: </td><td><?php echo $row['Aanschaf_dat'];?></td></tr>
	<tr><td>Aanschaf waarde: </td><td><?php echo "&euro; ".number_format((float)$row['Aanschaf_waarde'], 2, '.', '')."";?></td></tr>
	</table></p>
	<?php
}}else{
	echo "<i>Geen telefoon gevonden</i>";
}
?>
  </div>
</div>
<div class="card bg-light mb-3" style="max-width: 18rem;">
  <div class="card-header">asdf</div>
  <div class="card-body">
    <h5 class="card-title">Laptop</h5>
  <?php
  $sql = "SELECT * FROM IA_Gebruiker, IA_Laptop, IA_Locatie_RG WHERE Com_ID = :id AND IA_Locatie_RG.U_ID=IA_Gebruiker.U_ID AND IA_Gebruiker.U_ID=IA_Laptop.U_ID";
  $query = $conn->prepare($sql);
  $query->execute(array(':id' => $id));
  $rows = $query->fetchAll(PDO::FETCH_ASSOC);
  
$value = count($rows);
if ($value !=0){
foreach($rows as $row){
	?>
	<p class="card-text"><table>
	<tr><td>Barcode: </td><td><?php echo $row['Barcode'];?></td></tr>
	<tr><td>Merk: </td><td><?php echo $row['Merk'];?></td></tr>
	<tr><td>CPU: </td><td><?php echo $row['CPU'];?></td></tr>
	<tr><td>Memory: </td><td><?php echo $row['Memory'];?></td></tr>
	<tr><td>Inch: </td><td><?php echo $row['Inch'];?></td></tr>
	<tr><td>Aanschaf datum: </td><td><?php echo $row['Aanschaf_dat'];?></td></tr>
	<tr><td>Aanschaf waarde: </td><td><?php echo "&euro; ".number_format((float)$row['Aanschaf_waarde'], 2, '.', '')."";?></td></tr>
	<tr><td>Opmerkingen: </td><td><?php echo $row['Opmerkingen'];?></td></tr>
	</table></p>
	<?php
}}else{
	echo "<i>Geen laptop gevonden</i>";
}
?>
  </div>
</div>
<div class="card bg-light mb-3" style="max-width: 18rem;">
  <div class="card-header">asdf</div>
  <div class="card-body">
    <h5 class="card-title">Tablet</h5>
  <?php
  $sql = "SELECT * FROM IA_Gebruiker, IA_Tablet, IA_Locatie_RG WHERE Com_ID = :id AND IA_Locatie_RG.U_ID=IA_Gebruiker.U_ID AND IA_Gebruiker.U_ID=IA_Tablet.U_ID";
  $query = $conn->prepare($sql);
  $query->execute(array(':id' => $id));
  $rows = $query->fetchAll(PDO::FETCH_ASSOC);
  
$value = count($rows);
if ($value !=0){
foreach($rows as $row){
	?>
	<p class="card-text"><table>
	<tr><td>Barcode: </td><td><?php echo $row['Barcode'];?></td></tr>
	<tr><td>Merk: </td><td><?php echo $row['Merk'];?></td></tr>
	<tr><td>Model: </td><td><?php echo $row['Model'];?></td></tr>
	<tr><td>Opslagcapaciteit: </td><td><?php echo $row['Opslagcapaciteit'];?></td></tr>
	<tr><td>Inch: </td><td><?php echo $row['Inch'];?></td></tr>
	<tr><td>Aanschaf datum: </td><td><?php echo $row['Aanschaf_dat'];?></td></tr>
	<tr><td>Aanschaf waarde: </td><td><?php echo "&euro; ".number_format((float)$row['Aanschaf_waarde'], 2, '.', '')."";?></td></tr>
	</table></p>
	<?php
}}else{
	echo "<i>Geen tablet gevonden</i>";
}
?>
  </div>
</div>

<div class="card bg-light mb-3" style="max-width: 18rem;">
  <div class="card-header">asdf</div>
  <div class="card-body">
    <h5 class="card-title">Opmerkingen</h5>
  <div class="comm">
    <label>Voeg opmerkingen toe</label><br>
	<form id="comment" action="edit/updateOpmerk.php" method="post">
	<textarea name="comment" style="resize:none; width: 100%; height: 20%;"><?php echo $comm;?></textarea><br>
	<input type="hidden" name="view" value="<?php echo $id;?>"/>
	<input type="submit" value="Edit" name="submit" class='btn btn-success' />
	</form>
  </div>
</div>
</div>
</div>
<div class="accordion" id="accordionExample">
<div class="card">
    <div class="card-header" id="headingOne">
      <h5 class="mb-0">
        <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
          Monitor
        </button>
      </h5>
    </div>
    <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">

        <div class="card-group">     
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
	<div class="card">
    <div class="card-body">
	
	<table>
        <tr><td>Monitorbarcode: </td><td><?php echo $row['Barcode'];?></td></tr>
        <tr><td>Merk: </td><td><?php echo $row['Merk'];?></td></tr>
        <tr><td>Type: </td><td><?php echo $row['Type'];?></td></tr>
        <tr><td>Inch: </td><td><?php echo $row['Inch'];?></td></tr>
        <tr><td>Aanschaf datum: </td><td><?php echo $monnewDate; ?></td></tr>
        <tr><td>Aanschaf waarde: </td><td><?php echo "&euro; ".number_format((float)$row['Aanschaf_waarde'], 2, '.', '')."";?></td></tr>
	</table>
	</div>
  </div>
<?php
} else{
    echo "<i>Geen monitoren gevonden</i>";
}
?>
    </div>
  </div>
</div>
  <div class="card">
    <div class="card-header" id="headingTwo">
      <h5 class="mb-0">
        <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
          Software
        </button>
      </h5>
    </div>

    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
      <div class="card-body">
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
?>      </div>
    </div>
  </div>
  <div class="card">
    <div class="card-header" id="headingThree">
      <h5 class="mb-0">
        <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
          Randapparatuur
        </button>
      </h5>
    </div>
    <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
      <div class="card-body">
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
  ?>
      </div>
    </div>
  </div>
</div>
</body>
</html>