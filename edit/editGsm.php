<html><head><link rel="icon" sizes="32x32" type="image/png" href="../favicon.ico"/><title>Inventadmin</title>
<meta http-equiv="X-UA-Compatible" content="IE=edge;" /><?php
error_reporting(E_ALL); ini_set('display_errors', 1);
	include "../includes/connection.php";
	include "../includes/scripts.php";?>
<script><?php include "../includes/js/maxtime.js" ?>
</script>
<style>
input, select, textarea{
	max-width: 275px;
}
</style>
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

<?php
	$id = $_GET['edit'];
	
	$sql = "SELECT * FROM IA_Telefoon, IA_Gebruiker WHERE Gsm_ID=:id AND IA_Gebruiker.U_ID=IA_Telefoon.U_ID";
	$query = $conn->prepare($sql);
	$query->execute(array(':id' => $id));

	while($row = $query->fetch(PDO::FETCH_ASSOC))
	{
    $nummer = $row['Telefoonnummer'];
    $merk = $row['Merk'];
    $model = $row['Model'];
    $serial = $row['Serialnummer'];
    $imeireq = $row['IMEI_nummer_required'];
    $imeiopt = $row['IMEI_nummer_optionel'];
    $datum = $row['Aanschaf_dat'];
    $waarde = $row['Aanschaf_waarde'];
	$user_id = $row['U_ID'];
	$gebruiker = $row['Gebruiker'];
	
	$newDate = date("Y-m-d", strtotime($datum));
	}
	
	
?> 
<body>

<H4>Telefoon</H4>
<form name="form1" method="post" class="form-group" action="editGsm.php?edit= <?php $id; ?>" enctype="multipart/form-data">
	<div class="form-group">
		<label class="control-label col-sm-2" for="userid">Gebruiker:</label>
			<div class="col-sm-10">
			<?php $sql = $conn->query("SELECT U_ID, Gebruiker FROM IA_Gebruiker"); ?>
			
					<select  name="userid">
					<option value="<?php echo $user_id; ?>" selected><?php echo $gebruiker ?></option>
					<option value=""> Geen gebruiker</option>
			<?php	while ($row = $sql->fetch(PDO::FETCH_ASSOC)) {
					   echo '<option value="'.$row['U_ID'].'">'.$row['Gebruiker'].'</option>';
					} ?>
					</select>
			</div>
		</div>
	<div class="form-group">
		<label class="control-label col-sm-2" for="nummer">Telefoonnummer:</label>
		<div class="col-sm-10">
			<input type='text' name='nummer' value="<?php echo $nummer; ?>"  placeholder='Telefoonnummer' class='form-control' required>
		</div>
	</div>
	<div class="form-group">
		<label class="control-label col-sm-2" for="merk">Merk:</label>
		<div class="col-sm-10">
			<input type='text' name='merk' value="<?php echo $merk; ?>" placeholder='Merk' class='form-control'>
		</div>
	</div>
	<div class="form-group">
		<label class="control-label col-sm-2" for="model">Model:</label>
		<div class="col-sm-10">
			<input type='text' name='model' value="<?php echo $model; ?>" placeholder='Model' class='form-control'>
		</div>
	</div>
	<div class="form-group">
		<label class="control-label col-sm-2" for="serial">Serialnummer:</label>
		<div class="col-sm-10">
			<input type='text' name='serial' value="<?php echo $serial; ?>" placeholder='Serialnummer' class='form-control'>
		</div>
	</div>
	<div class="form-group">
		<label class="control-label col-sm-2" for="imeireq">IMEI-nummer:</label>
		<div class="col-sm-10">
			<input type='text' name='imeireq' value="<?php echo $imeireq; ?>" placeholder='IMEI-nummer' class='form-control'>
		</div>
	</div>
	<div class="form-group">
		<label class="control-label col-sm-2" for="imeiopt">IMEI-nummer: <i>(Niet verplicht!)</i></label>
		<div class="col-sm-10">
			<input type='text' name='imeiopt' value="<?php echo $imeiopt; ?>" placeholder='IMEI-nummer' class='form-control'>
		</div>
	</div>
	<div class="form-group">
		<label class="control-label col-sm-2" for="date">Aanschaf datum:</label>
		<div class="col-sm-10">
			<input type='date' id='picker' value="<?php echo $newDate; ?>" name='date' class='form-control'>
		</div>
	</div>
	<div class="form-group">
		<label class="control-label col-sm-2" for="waarde">Aanschaf waarde:</label>
		<div class="col-sm-10">
			<input type='text' name='waarde' value="<?php echo $waarde; ?>" placeholder='Aanschaf waarde' class='form-control'>
		</div>
	</div>
	<div class="form-group">
		<label class="control-label col-sm-2" for="file">Afbeelding apparaat:</label>
		<div class="col-sm-10">
			<input type="file" name="file">
		</div>
	</div>
		<input type="hidden" name="id" value="<?php echo $_GET['edit'];?>">
		<input type='submit' name='update' class='btn btn-success' value='Update'>
</form>
</body>
</html>
<?php
if(isset($_POST['update']))
{    
    $id = $_POST['id'];
    $userid = trim($_POST['userid']);
    $nummer = trim($_POST['nummer']);
    $merk = trim($_POST['merk']);
    $model = trim($_POST['model']);    
    $serial = trim($_POST['serial']);    
    $imeireq = trim($_POST['imeireq']);    
    $imeiopt = trim($_POST['imeiopt']);    
    $datum = trim($_POST['date']);    
    $waarde = trim($_POST['waarde']);    
	
	$sql = "SELECT * FROM IA_Telefoon WHERE Gsm_ID=:id";
	$query = $conn->prepare($sql);
	$query->execute(array(':id' => $id));
	
	while($row = $query->fetch(PDO::FETCH_ASSOC))
	{
    $deleteimg = $row['Picture_gsm'];
	}
	
    if(empty($userid) || empty($nummer) || empty($merk) || empty($model) || empty($serial) || empty($imeireq) || empty($datum) || empty($waarde)) {    
            
        if(empty($userid)) {
            echo "<font color='red'>Gebruiker niet gekozen.</font><br/>";
        }
        if(empty($nummer)) {
            echo "<font color='red'>Telefoonnummer niet ingevuld.</font><br/>";
        }
        if(empty($merk)) {
            echo "<font color='red'>Merk niet ingevuld.</font><br/>";
        }      
		if(empty($model)) {
            echo "<font color='red'>Model niet ingevuld.</font><br/>";
        }       
		if(empty($serial)) {
            echo "<font color='red'>Serialnummer niet ingevuld.</font><br/>";
        }       
		if(empty($imeireq)) {
            echo "<font color='red'>IMEI-nummer niet ingevuld.</font><br/>";
        } 
		if(empty($datum)) {
            echo "<font color='red'>Aanschaf datum niet ingevuld.</font><br/>";
        } 
		if(empty($waarde)) {
            echo "<font color='red'>Aanschaf waarde niet ingevuld.</font><br/>";
        } 
    } else {  
		if($_FILES['file']['error'] == 4 ){
			$sql = "UPDATE IA_Telefoon
						SET U_ID = :userid,
							Telefoonnummer = :nummer,
							Merk = :merk, 
							Model = :model, 
							Serialnummer = :serial, 
							IMEI_nummer_required = :imeireq, 
							IMEI_nummer_optionel = :imeiopt, 
							Aanschaf_dat = :datum, 
							Aanschaf_waarde = :waarde,
							Picture_gsm = NULL
					  WHERE Gsm_ID = :id";
					 
			$query = $conn->prepare($sql);
			$query->bindparam(":userid", $userid);
			$query->bindparam(':nummer', $nummer);
			$query->bindparam(':merk', $merk);
			$query->bindparam(':model', $model);
			$query->bindparam(':serial', $serial);
			$query->bindparam(':imeireq', $imeireq);
			$query->bindparam(':imeiopt', $imeiopt);
			$query->bindparam(':datum', $datum);
			$query->bindparam(':waarde', $waarde);
			$query->bindparam(':id', $id);
			$query->execute();
			
			if($deleteimg == 0){
				echo '<meta http-equiv="refresh" content="0;URL=https://portal.basrt.eu/inventadmin/" />';
			}else{
				unlink('//WEBSERVER03/Portal$/inventadmin/'.$deleteimg);
			}
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
							$sql = "UPDATE 	IA_Telefoon
										SET U_ID = :userid,
											Telefoonnummer = :nummer,
											Merk = :merk, 
											Model = :model, 
											Serialnummer = :serial, 
											IMEI_nummer_required = :imeireq, 
											IMEI_nummer_optionel = :imeiopt,
											Aanschaf_dat = :datum, 
											Aanschaf_waarde = :waarde,
											Picture_gsm = :pic
									  WHERE Gsm_ID = :id";
									 
							$query = $conn->prepare($sql);
							$query->bindparam(":userid", $userid);
							$query->bindparam(':nummer', $nummer);
							$query->bindparam(':merk', $merk);
							$query->bindparam(':model', $model);
							$query->bindparam(':serial', $serial);
							$query->bindparam(':imeireq', $imeireq);
							$query->bindparam(':imeiopt', $imeiopt);
							$query->bindparam(':datum', $datum);
							$query->bindparam(':waarde', $waarde);
							$query->bindparam(':pic', $img);
							$query->bindparam(':id', $id);
							$query->execute();
							
							unlink('//WEBSERVER03/Portal$/inventadmin/'.$deleteimg);
							
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
		
		$conn = null;

	}
}
?>
