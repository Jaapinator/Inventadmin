<html><head><link rel="icon" sizes="32x32" type="image/png" href="../favicon.ico"/><title>Inventadmin</title>
<meta http-equiv="X-UA-Compatible" content="IE=edge;" />
<?php
	include "../includes/connection.php";
	include "../includes/scripts.php";
?>
<script>
$(function(){
    var dtToday = new Date();
    
    var month = dtToday.getMonth() + 1;
    var day = dtToday.getDate();
    var year = dtToday.getFullYear();
    if(month < 10)
        month = '0' + month.toString();
    if(day < 10)
        day = '0' + day.toString();
    
    var maxDate = year + '-' + month + '-' + day;
    $('#picker').attr('max', maxDate);
});
</script>
<style>
input, select, textarea{
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
	<H4>Laptop</H4>
	<hr>
	<form method="post" action="insertLapForm.php" enctype="multipart/form-data" id="gsm_form">
	<div class="form-group">
		<label class="control-label col-sm-2" for="user">Gebruiker:</label>
			<div class="col-sm-10">
	<?php
	$sql = $conn->query("SELECT U_ID, Gebruiker FROM IA_Gebruiker ORDER BY Gebruiker"); 
					echo '<select  name="user" required>'; 
					echo '<option style="display:none" value="">Kies gebruiker van de laptop</option>';
					while ($row = $sql->fetch(PDO::FETCH_ASSOC)) {
					   echo '<option value="'.$row['U_ID'].'">'.$row['Gebruiker'].'</option>';
					}
					echo '</select>';
					?>
			</div>
	</div>
	<div class="form-group">
		<label class="control-label col-sm-2" for="barcode">Barcode:</label>
		<div class="col-sm-10">
			<input type='text' name='barcode'  placeholder='Barcode' class='form-control' required>
		</div>
	</div>
	<div class="form-group">
		<label class="control-label col-sm-2" for="name">Naam:</label>
		<div class="col-sm-10">
			<input type='text' name='name'  placeholder='Naam' class='form-control' required>
		</div>
	</div>
	<div class="form-group">
		<label class="control-label col-sm-2" for="merk">Merk:</label>
		<div class="col-sm-10">
			<input type='text' name='merk'  placeholder='Merk' class='form-control' required>
		</div>
	</div>
	<div class="form-group">
		<label class="control-label col-sm-2" for="cpu">CPU:</label>
		<div class="col-sm-10">
			<input type='text' name='cpu'  placeholder='CPU' class='form-control' required>
		</div>
	</div>
	<div class="form-group">
		<label class="control-label col-sm-2" for="memory">Memory:</label>
		<div class="col-sm-10">
			<input type='text' name='memory'  placeholder='Memory' class='form-control' required>
		</div>
	</div>
	<div class="form-group">
		<label class="control-label col-sm-2" for="inch">Inch:</label>
		<div class="col-sm-10">
			<input type='text' name='inch'  placeholder='Inch' class='form-control' required>
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
		<label class="control-label col-sm-2" for="file">Foto laptop:</label>
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
	<input type="submit" name="submit" value="Voeg toe" class="btn btn-success">
	</form>
	</div>
</div>
</body>
</html>
<?php
error_reporting(E_ALL); ini_set('display_errors', 1);

if (isset($_POST['submit'])){
	$userid = $_POST['user'];
	$inch = $_POST['inch'];
	$barcode = $_POST['barcode'];
	$name = $_POST['name'];
	$merk = $_POST['merk'];
	$cpu = $_POST['cpu'];
	$ram = $_POST['memory'];
	$date = $_POST['datum'];
	$waarde = $_POST['prijs'];
	$opmerkingen = $_POST['comment'];
	
	if($_FILES['file']['error'] == 4){
		$stmt = $conn->prepare("INSERT INTO IA_Laptop (U_ID, Barcode, Lap_naam, Merk, CPU, Memory, Inch, Aanschaf_dat, Aanschaf_waarde, Opmerkingen, Picture_lap)
												VALUES (?,?,?,?,?,?,?,?,?,?,?)");
		$stmt->execute([$userid, $barcode, $name, $merk, $cpu, $ram, $inch, $date, $waarde, $opmerkingen, NULL]);
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
					$fileDestination = '//WEBSERVER03/Portal$/inventadmin/includes/images/laptop/'.$fileNameNew;
					move_uploaded_file($fileTmpName, $fileDestination);
					try{
						$dir = 'includes/images/laptop/';
						$img = $dir.$fileNameNew;
						$stmt = $conn->prepare("INSERT INTO IA_Laptop (U_ID, Barcode, Lap_naam, Merk, CPU, Memory, Inch, Aanschaf_dat, Aanschaf_waarde, Opmerkingen, Picture_lap)
												VALUES (?,?,?,?,?,?,?,?,?,?,?)");
						$stmt->execute([$userid, $barcode, $name, $merk, $cpu, $ram, $inch, $date, $waarde, $opmerkingen, $img]);
						echo '<meta http-equiv="refresh" content="0;URL=https://portal.basrt.eu/inventadmin/" />';
					}
					catch(PDOException $e){
						echo $stmt . "<br>" . $e->getMessage();
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