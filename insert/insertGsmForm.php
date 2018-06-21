<html><head><link rel="icon" sizes="32x32" type="image/png" href="../favicon.ico"/><title>Inventadmin</title>
<meta http-equiv="X-UA-Compatible" content="IE=edge;" />
<?php
	include "../includes/connection.php";
	include "../includes/scripts.php";
?>
<script><?php include "../includes/js/maxtime.js" ?>
</script>
<style>
input, select{
	max-width: 275px;
}
</style>
</head><body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top">
	<a class="navbar-brand" href="https://portal.basrt.eu/">Inventadmin</a>
	<div class="collapse navbar-collapse" id="navbarNavDropdown">
		<ul class="navbar-nav">
			<li class="nav-item">
				<a class="nav-link" href='../index.php'>Overzicht</a>
			</li>
		</ul>
	</div>
</nav>
<div class="container">
	<div class="main-login main-center">
	<H4>Telefoon</H4>
	<hr>
	<form method="post" action="insertGsmForm.php" enctype="multipart/form-data" id="gsm_form">
	<div class="form-group">
		<label class="control-label col-sm-2" for="user">Gebruiker:</label>
			<div class="col-sm-10">
	<?php
	$sql = $conn->query("SELECT U_ID, Gebruiker FROM IA_Gebruiker ORDER BY Gebruiker"); 
					echo '<select  name="user" required>'; 
					echo '<option style="display:none" value="">Kies gebruiker van de telefoon</option>';
					while ($row = $sql->fetch(PDO::FETCH_ASSOC)) {
					   echo '<option value="'.$row['U_ID'].'">'.$row['Gebruiker'].'</option>';
					}
					echo '</select>';
					?>
			</div>
	</div>
	<div class="form-group">
		<label class="control-label col-sm-2" for="nummer">Telefoonnummer:</label>
		<div class="col-sm-10">
			<input type='text' name='nummer'  placeholder='Telefoonnummer' class='form-control' required>
		</div>
	</div>
	<div class="form-group">
		<label class="control-label col-sm-2" for="merk">Merk:</label>
		<div class="col-sm-10">
			<input type='text' name='merk'  placeholder='Merk' class='form-control' required>
		</div>
	</div>
	<div class="form-group">
		<label class="control-label col-sm-2" for="model">Model:</label>
		<div class="col-sm-10">
			<input type='text' name='model'  placeholder='Model' class='form-control' required>
		</div>
	</div>
	<div class="form-group">
		<label class="control-label col-sm-2" for="serial">Serialnummer:</label>
		<div class="col-sm-10">
			<input type='text' name='serial'  placeholder='Serialnummer' class='form-control' required>
		</div>
	</div>
	<div class="form-group">
		<label class="control-label col-sm-2" for="imei-req">IMEI-nummer:</label>
		<div class="col-sm-10">
			<input type='text' name='imei-req'  placeholder='IMEI-nummer' class='form-control' required>
		</div>
	</div>
	<div class="form-group">
		<label class="control-label col-sm-2" for="imei-opt">IMEI-nummer:</label>
		<div class="col-sm-10">
			<input type='text' name='imei-opt'  placeholder='IMEI-nummer' class='form-control' required>
		</div>
	</div>
	<div class="form-group">
		<label class="control-label col-sm-2" for="datum">Aanschaf datum:</label>
		<div class="col-sm-10">
			<input type='date' name='datum' id="picker"  placeholder='Aaschaf datum' class='form-control' required>
		</div>
	</div>
	<div class="form-group">
		<label class="control-label col-sm-2" for="prijs">Aaschaf waarde:</label>
		<div class="col-sm-10">
			<input type='text' name='prijs'  placeholder='Aanschaf waarde' class='form-control' required>
		</div>
	</div>
	<div class="form-group">
		<label class="control-label col-sm-2" for="file">Foto telefoon:</label>
		<div class="col-sm-10">
			<input type="file" name="file">
		</div>
	</div>
		<input type="submit" name="submit" value="Voeg toe" class='btn btn-success'>
	</form>
	</div>
</div>
</body>
</html>
<?php
error_reporting(E_ALL); ini_set('display_errors', 1);

if (isset($_POST['submit'])){
	$userid = $_POST['user'];
	$nummer = $_POST['nummer'];
	$merk = $_POST['merk'];
	$model = $_POST['model'];
	$serial = $_POST['serial'];
	$imeireq = $_POST['imei-req'];
	$imeiopt = $_POST['imei-opt'];
	$date = $_POST['datum'];
	$waarde = $_POST['prijs'];
	
	if($_FILES['file']['error'] == 4 ){
		$stmt = $conn->prepare("INSERT INTO IA_Telefoon (U_ID, Telefoonnummer, Merk, Model, Serialnummer, IMEI_nummer_required, IMEI_nummer_optionel, Aanschaf_dat, Aanschaf_waarde, Picture_gsm)
											VALUES (?,?,?,?,?,?,?,?,?,?)");
		$stmt->execute([$userid, $nummer, $merk, $model, $serial, $imeireq, $imeiopt, $date, $waarde, NULL]);
		echo '<meta http-equiv="refresh" content="0;URL=https://portal.basrt.eu/inventadmin/" />';
	}else{		
		$file = $_FILES['file'];
		
		$fileName = $_FILES['file']['name'];
		$fileTmpName = $_FILES['file']['tmp_name'];
		$fileSize = $_FILES['file']['size'];
		$fileError = $_FILES['file']['error'];
		$fileType = $_FILES['file']['type'];
		
		$fileExt = explode('.', $fileName);
		$fileActualExt = strtolower(end($fileExt));
		
		$allowed = array('jpg', 'jpeg', 'png');
		
		if(in_array($fileActualExt, $allowed)){
			if($fileError === 0){
				if($fileSize < 1000000){
					$fileNameNew = uniqid('', true).".".$fileActualExt;
					$fileDestination = '//WEBSERVER03/Portal$/inventadmin/includes/images/telefoon/'.$fileNameNew;
					move_uploaded_file($fileTmpName, $fileDestination);
					try{
						$dir = 'includes/images/telefoon/';
						$img = $dir.$fileNameNew;
						$stmt = $conn->prepare("INSERT INTO IA_Telefoon (U_ID, Telefoonnummer, Merk, Model, Serialnummer, IMEI_nummer_required, IMEI_nummer_optionel, Aanschaf_dat, Aanschaf_waarde, Picture_gsm)
												VALUES (?,?,?,?,?,?,?,?,?,?)");
						$stmt->execute([$userid, $nummer, $merk, $model, $serial, $imeireq, $imeiopt, $date, $waarde, $img]);
						echo '<meta http-equiv="refresh" content="0;URL=https://portal.basrt.eu/inventadmin/" />';
					}
					catch(PDOException $e){
						echo $stmt . "<br>" . $e->getMEssage();
					}
				}else{
					echo "Your file is too big!";
				}
			}else{
				echo "There was an error uploading your file!";
			}
		}else{
			echo "You can't upload files of this type!";
		}
	}
}
$conn = null;

?>