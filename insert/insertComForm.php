<html><head><link rel="icon" sizes="32x32" type="image/png" href="../favicon.ico"/><title>Inventadmin</title>
<meta http-equiv="X-UA-Compatible" content="IE=edge;" /><?php
	include "../includes/connection.php";
	include "../includes/scripts.php";
?>
<script src="../includes/js/modernizr-custom.js"></script>
<script><?php include "../includes/js/maxtime.js" ?>
</script>
<style>
input, select, textarea{
	max-width: 275px;
}
</style>
</head>
<body>
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
<H4> Voeg Computer toe</H4>
<hr>
<form id='com_form' action='insertComForm.php' method='post' class="form-group" enctype="multipart/form-data">
	<div class="form-group">
		<label class="control-label col-sm-2" for="com_barcode">Computer barcode:</label>
		<div class="col-sm-10">
			<input type='text' name='com_barcode'   placeholder='Barcode' class='form-control' required>
		</div>
	</div>
	<div class="form-group">
		<label class="control-label col-sm-2" for="com_naam">Computernaam:</label>
		<div class="col-sm-10">
			<input type='text' name='com_naam'  placeholder='Computernaam' class='form-control' required>
		</div>
	</div>
	<div class="form-group">
		<label class="control-label col-sm-2" for="com_ip">Ip-adres:</label>
		<div class="col-sm-10">
			<input type='text' name='com_ip' placeholder='Ip-adres' class='form-control'>
		</div>
	</div>
	<div class="form-group">
		<label class="control-label col-sm-2" for="com_merk">Merk:</label>
		<div class="col-sm-10">
			<input type='text' name='com_merk' placeholder='Merk' class='form-control'>
		</div>
	</div>
	<div class="form-group">
		<label class="control-label col-sm-2" for="com_merk">Model:</label>
		<div class="col-sm-10">
			<input type='text' name='com_model' placeholder='Model' class='form-control'>
		</div>
	</div>
	<div class="form-group">
		<label class="control-label col-sm-2" for="com_cpu">Processor:</label>
		<div class="col-sm-10">
			<input type='text' name='com_cpu'  placeholder='CPU' class='form-control'>
		</div>
	</div>
	<div class="form-group">
		<label class="control-label col-sm-2" for="com_ram">Ram geheugen:</label>
		<div class="col-sm-10">
			<input type='text' name='com_ram'  placeholder='RAM' class='form-control'>
		</div>
	</div>
	<div class="form-group">
		<label class="control-label col-sm-2" for="com_moed">Moederbord:</label>
		<div class="col-sm-10">
			<input type='text' name='com_moed' placeholder='Moederbord' class='form-control'>
		</div>
	</div>
	<div class="form-group">
		<label class="control-label col-sm-2" for="com_serial">Serialnummer:</label>
		<div class="col-sm-10">
			<input type='text' name='com_serial' placeholder='Serialnummer' class='form-control'>
		</div>
	</div>
	<div class="form-group">
		<label class="control-label col-sm-2" for="com_a_date">Aanschaf datum:</label>
		<div class="col-sm-10">
			<input type='date' id='picker' name='com_a_date' placeholder='Aanschaf datum' class='form-control'>
		</div>
	</div>
	<div class="form-group">
		<label class="control-label col-sm-2" for="com_a_prijs">Aanschaf waarde:</label>
		<div class="col-sm-10">
			<input type='text' name='com_a_prijs' placeholder='Aanschaf waarde' class='form-control'>
		</div>
	</div>
	<div class="form-group">
		<label class="control-label col-sm-2" for="file">Foto device:</label>
		<div class="col-sm-10">
			<input type="file" name="file">
		</div>
	</div>
	<div class="form-group">
		<label class="control-label col-sm-2" for="comment">Opmerkingen:</label>
		<div class="col-sm-10">
			<textarea class="form-control" rows="5" name='comment' placeholder='Opmerkingen'></textarea>
		</div>
	</div>
		<input type='submit' name='submit' class='btn btn-success' value='Voeg toe'>
</form>
</div>
</div>
</body>
</html>
<?php
if (isset($_POST['submit']))
	{
	$com_barcode = $_POST['com_barcode'];
	$com_naam = $_POST['com_naam'];
	$com_ip = $_POST['com_ip'];
	$com_merk = $_POST['com_merk'];
	$com_model = $_POST['com_model'];
	$com_cpu = $_POST['com_cpu'];
	$com_ram = $_POST['com_ram'];
	$com_moed = $_POST['com_moed'];
	$com_serial = $_POST['com_serial'];
	$com_a_date = $_POST['com_a_date'];
	$com_a_prijs = $_POST['com_a_prijs'];
	$comment = $_POST['comment'];
	
	$file = $_FILES['file'];
	$fileName = $_FILES['file']['name'];
	$fileTmpName = $_FILES['file']['tmp_name'];
	$fileSize = $_FILES['file']['size'];
	$fileError = $_FILES['file']['error'];
	$fileType = $_FILES['file']['type'];
	if($com_ip == NULL){
		if ($_FILES['file']['error'] == 4)
			{
			try
				{
				$stmt = $conn->prepare("INSERT INTO IA_Devices (Barcode, Naam, Ip_adres, Merk, Model, CPU, Memory, Moederbord, Serialnummer, Aanschaf_dat, Aanschaf_waarde, Opmerkingen, Picture_dev)
													VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?)");
				$stmt->execute([$com_barcode, $com_naam, $com_ip, $com_merk, $com_model, $com_cpu, $com_ram, $com_moed, $com_serial, $com_a_date, $com_a_prijs, $comment, NULL]);
				echo '<meta http-equiv="refresh" content="0;URL=https://portal.basrt.eu/inventadmin/" />';
				}

			catch(PDOException $e)
				{
				echo $stmt . "<br />" . $e->getMessage();
				echo '<meta http-equiv="refresh" content="0;URL=https://portal.basrt.eu/inventadmin/insert/insertComForm.php" />';
				}
			}
		  else
			{
			$fileExt = explode('.', $fileName);
			$fileActualExt = strtolower(end($fileExt));
			$allowed = array(
				'jpg',
				'jpeg',
				'png'
			);
			if (in_array($fileActualExt, $allowed))
				{
				if ($fileError === 0)
					{
					if ($fileSize < 1000000)
						{
						$fileNameNew = uniqid('', true) . "." . $fileActualExt;
						$fileDestination = '//WEBSERVER03/Portal$/inventadmin/includes/images/devices/' . $fileNameNew;
						move_uploaded_file($fileTmpName, $fileDestination);
						try
							{
							$dir = 'includes/images/devices/';
							$img = $dir . $fileNameNew;
							$stmt = $conn->prepare("INSERT INTO IA_Devices (Barcode, Naam, Ip_adres, Merk, Model, CPU, Memory, Moederbord, Serialnummer, Aanschaf_dat, Aanschaf_waarde, Opmerkingen, Picture_dev)
														VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?)");
							$stmt->execute([$com_barcode, $com_naam, $com_ip, $com_merk, $com_model, $com_cpu, $com_ram, $com_moed, $com_serial, $com_a_date, $com_a_prijs, $comment, $img]);
							echo '<meta http-equiv="refresh" content="0;URL=https://portal.basrt.eu/inventadmin/" />';
							}

						catch(PDOException $e)
							{
							echo $stmt . "<br />" . $e->getMessage();
							echo '<meta http-equiv="refresh" content="0;URL=https://portal.basrt.eu/inventadmin/insert/insertComForm.php" />';
							}
						}
					  else
						{
						echo "Your file is too big!";
						}
					}
				  else
					{
					echo "There was an error uploading your file!";
					}
				}
			  else
				{
				echo "You can't upload files of this type!";
				}
			}
	}else{	
	$result = $conn->prepare("SELECT count(*) FROM IA_Devices WHERE Ip_adres=:ip");
	$result->bindParam(':ip', $com_ip, PDO::PARAM_STR);
	$result->execute();
	$rowCount = $result->fetchColumn(0);
	
	if ($rowCount == 0)
		{
		if ($_FILES['file']['error'] == 4)
			{
			try
				{
				$stmt = $conn->prepare("INSERT INTO IA_Devices (Barcode, Naam, Ip_adres, Merk, Model, CPU, Memory, Moederbord, Serialnummer, Aanschaf_dat, Aanschaf_waarde, Opmerkingen, Picture_dev)
													VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?)");
				$stmt->execute([$com_barcode, $com_naam, $com_ip, $com_merk, $com_model, $com_cpu, $com_ram, $com_moed, $com_serial, $com_a_date, $com_a_prijs, $comment, NULL]);
				echo '<meta http-equiv="refresh" content="0;URL=https://portal.basrt.eu/inventadmin/" />';
				}

			catch(PDOException $e)
				{
				echo $stmt . "<br />" . $e->getMessage();
				echo '<meta http-equiv="refresh" content="0;URL=https://portal.basrt.eu/inventadmin/insert/insertComForm.php" />';
				}
			}
		  else
			{
			$fileExt = explode('.', $fileName);
			$fileActualExt = strtolower(end($fileExt));
			$allowed = array(
				'jpg',
				'jpeg',
				'png'
			);
			if (in_array($fileActualExt, $allowed))
				{
				if ($fileError === 0)
					{
					if ($fileSize < 1000000)
						{
						$fileNameNew = uniqid('', true) . "." . $fileActualExt;
						$fileDestination = '//WEBSERVER03/Portal$/inventadmin/includes/images/devices/' . $fileNameNew;
						move_uploaded_file($fileTmpName, $fileDestination);
						try
							{
							$dir = 'includes/images/devices/';
							$img = $dir . $fileNameNew;
							$stmt = $conn->prepare("INSERT INTO IA_Devices (Barcode, Naam, Ip_adres, Merk, Model, CPU, Memory, Moederbord, Serialnummer, Aanschaf_dat, Aanschaf_waarde, Opmerkingen, Picture_dev)
														VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?)");
							$stmt->execute([$com_barcode, $com_naam, $com_ip, $com_merk, $com_model, $com_cpu, $com_ram, $com_moed, $com_serial, $com_a_date, $com_a_prijs, $comment, $img]);
							echo '<meta http-equiv="refresh" content="0;URL=https://portal.basrt.eu/inventadmin/" />';
							}

						catch(PDOException $e)
							{
							echo $stmt . "<br />" . $e->getMessage();
							echo '<meta http-equiv="refresh" content="0;URL=https://portal.basrt.eu/inventadmin/insert/insertComForm.php" />';
							}
						}
					  else
						{
						echo "Your file is too big!";
						}
					}
				  else
					{
					echo "There was an error uploading your file!";
					}
				}
			  else
				{
				echo "You can't upload files of this type!";
				}
			}
		}
	  else
		{
		echo "<script> alert('Ip-adres bestaat al');</script>";
		echo '<meta http-equiv="refresh" content="0;URL=https://portal.basrt.eu/inventadmin/insert/insertComForm.php" />';
		}
	}
	}
$conn = null;
?>