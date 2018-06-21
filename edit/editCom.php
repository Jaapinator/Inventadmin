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
	
	$sql = "SELECT * FROM IA_Devices WHERE Dev_ID=:id";
	$query = $conn->prepare($sql);
	$query->execute(array(':id' => $id));

	while($row = $query->fetch(PDO::FETCH_ASSOC))
	{
    $barcode = $row['Barcode'];
	$naam = $row['Naam'];
    $ip = $row['Ip_adres'];
    $merk = $row['Merk'];
    $model = $row['Model'];
    $cpu = $row['CPU'];
    $mem = $row['Memory'];
    $moed = $row['Moederbord'];
    $serial = $row['Serialnummer'];
    $datum = $row['Aanschaf_dat'];
    $waarde = $row['Aanschaf_waarde'];
    $comment = $row['Opmerkingen'];
	
	$newDate = date("Y-m-d", strtotime($datum));
	}
	
	
?> 
<body>
<H4>Computer</H4>
<form name="form1" method="post" class="form-group" action="editCom.php?edit= <?php $id; ?>" enctype="multipart/form-data">
		<div class="form-group">
		<label class="control-label col-sm-2" for="barcode">Computer barcode:</label>
		<div class="col-sm-10">
			<input type='text' name='barcode' value="<?php echo $barcode; ?>"  placeholder='Barcode' class='form-control' required>
		</div>
	</div>
	<div class="form-group">
		<label class="control-label col-sm-2" for="naam">Computernaam:</label>
		<div class="col-sm-10">
			<input type='text' name='naam' value="<?php echo $naam; ?>" placeholder='Computernaam' class='form-control' required>
		</div>
	</div>
	<div class="form-group">
		<label class="control-label col-sm-2" for="ip">Ip-adres:</label>
		<div class="col-sm-10">
			<input type='text' name='ip' value="<?php echo $ip; ?>" placeholder='Ip-adres' class='form-control'>
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
		<label class="control-label col-sm-2" for="cpu">Processor:</label>
		<div class="col-sm-10">
			<input type='text' name='cpu' value="<?php echo $cpu; ?>" placeholder='CPU' class='form-control'>
		</div>
	</div>
	<div class="form-group">
		<label class="control-label col-sm-2" for="mem">Ram geheugen:</label>
		<div class="col-sm-10">
			<input type='text' name='mem' value="<?php echo $mem; ?>" placeholder='RAM' class='form-control'>
		</div>
	</div>
	<div class="form-group">
		<label class="control-label col-sm-2" for="moed">Moederbord:</label>
		<div class="col-sm-10">
			<input type='text' name='moed' value="<?php echo $moed; ?>" placeholder='Moederbord' class='form-control'>
		</div>
	</div>
	<div class="form-group">
		<label class="control-label col-sm-2" for="erial">Serialnummer:</label>
		<div class="col-sm-10">
			<input type='text' name='serial' value="<?php echo $serial; ?>" placeholder='Serialnummer' class='form-control'>
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
		<label class="control-label col-sm-2" for="comment">Opmerkingen:</label>
		<div class="col-sm-10">
			<textarea  rows="5" name='comment' placeholder='Opmerkingen' class="form-control"><?php echo $comment; ?></textarea>
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
    
    $barcode = trim($_POST['barcode']);
	$naam = trim($_POST['naam']);
    $merk = trim($_POST['merk']);
    $model = trim($_POST['model']);
    $ip = trim($_POST['ip']);    
    $cpu = trim($_POST['cpu']);    
    $mem = trim($_POST['mem']);    
    $moed = trim($_POST['moed']);    
    $serial = trim($_POST['serial']);    
    $datum = trim($_POST['date']);    
    $waarde = trim($_POST['waarde']);    
    $opmerkingen = trim($_POST['comment']);  
	
	$sql = "SELECT * FROM IA_Devices WHERE Dev_ID=:id";
	$query = $conn->prepare($sql);
	$query->execute(array(':id' => $id));
	
	while($row = $query->fetch(PDO::FETCH_ASSOC))
	{
    $deleteimg = $row['Picture_dev'];
	}	
	
    if(empty($barcode) || empty($merk)) {    
            
        if(empty($barcode)) {
            echo "<font color='red'>Barcode niet ingevuld.</font><br/>";
        }
		if(empty($naam)) {
            echo "<font color='red'>Computer naam niet ingevuld.</font><br/>";
        }
    } else {    
    if($_FILES['file']['error'] == 4 ){
        $sql = "UPDATE IA_Devices
					SET Barcode = :barcode,
						Naam = :naam,
						Ip_adres = :ip, 
						Merk = :merk, 
						Model = :model, 
						CPU = :cpu, 
						Memory = :mem,  
						Moederbord = :moed, 
						Serialnummer = :serial, 
						Aanschaf_dat = :datum, 
						Aanschaf_waarde = :waarde, 
						Opmerkingen = :comment, 
						Picture_dev = NULL
				  WHERE Dev_ID = :id";
				 
		$query = $conn->prepare($sql);
		$query->bindparam(":barcode", $barcode);
		$query->bindparam(':naam', $naam);
		$query->bindparam(':ip', $ip);
		$query->bindparam(':merk', $merk);
		$query->bindparam(':model', $model);
		$query->bindparam(':cpu', $cpu);
		$query->bindparam(':mem', $mem);
		$query->bindparam(':moed', $moed);
		$query->bindparam(':serial', $serial);
		$query->bindparam(':datum', $datum);
		$query->bindparam(':waarde', $waarde);
		$query->bindparam(':comment', $opmerkingen);
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
						$fileDestination = '//WEBSERVER03/Portal$/inventadmin/includes/images/devices/'.$fileNameNew;
						move_uploaded_file($fileTmpName, $fileDestination);
						try{
							$dir = 'includes/images/telefoon/';
							$img = $dir.$fileNameNew;
							$sql = "UPDATE IA_Devices
										SET Barcode = :barcode,
											Naam = :naam,
											Ip_adres = :ip, 
											Merk = :merk, 
											Model = :model, 
											CPU = :cpu, 
											Memory = :mem,  
											Moederbord = :moed, 
											Serialnummer = :serial, 
											Aanschaf_dat = :datum, 
											Aanschaf_waarde = :waarde, 
											Opmerkingen = :comment, 
											Picture_dev = :img
									  WHERE Dev_ID = :id";
									 
							$query = $conn->prepare($sql);
							$query->bindparam(":barcode", $barcode);
							$query->bindparam(':naam', $naam);
							$query->bindparam(':ip', $ip);
							$query->bindparam(':merk', $merk);
							$query->bindparam(':model', $model);
							$query->bindparam(':cpu', $cpu);
							$query->bindparam(':mem', $mem);
							$query->bindparam(':moed', $moed);
							$query->bindparam(':serial', $serial);
							$query->bindparam(':datum', $datum);
							$query->bindparam(':waarde', $waarde);
							$query->bindparam(':comment', $opmerkingen);
							$query->bindparam(':img', $img);
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
	} 
}
?>