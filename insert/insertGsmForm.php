<html><head><link rel="icon" sizes="32x32" type="image/png" href="../favicon.ico"/><title>Inventadmin</title>
<meta http-equiv="X-UA-Compatible" content="IE=edge;" /><style><?php
	include "../includes/css/style.css";
?></style><?php
	include "../includes/connection.php";
?><script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
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
</script></head><body><?php
	echo "<div class='navbar'>";
	echo "<a href='https://portal.basrt.eu/index/login.php'>Portal</a>";
	echo "<a href='../index.php'>Overzicht</a>";
	echo "</div>";
	?>
	<div class='form'>
	<H4>Telefoon</H4>
	<form method="post" action="insertGsmForm.php" enctype="multipart/form-data" id="gsm_form">
	<?php
	$sql = $conn->query("SELECT U_ID, Gebruiker FROM IA_Gebruiker ORDER BY Gebruiker"); 
					
					echo "<label>Gebruiker</label>";
					echo '<select  name="user" required>'; 
					echo '<option style="display:none" value="">Kies gebruiker van de telefoon</option>';
					while ($row = $sql->fetch(PDO::FETCH_ASSOC)) {
					   echo '<option value="'.$row['U_ID'].'">'.$row['Gebruiker'].'</option>';
					}
					echo '</select>';
					?>
	<label>Telefoonnummer</label>
	<input type="text" name="nummer" placeholder="Telefoonnummer" required>
	<label>Merk</label>
	<input type="text" name="merk" placeholder="Merk" required>
	<label>Model</label>
	<input type="text" name="model" placeholder="Model" required>
	<label>Aanschaf datum</label>
	<input type="date" id="picker" name="datum" required>
	<label>Aanschaf waarde</label>
	<input type="text" name="prijs" placeholder="Aanschaf waarde" required>
	<label>Foto telefoon</label>
	<br>
	<input type="file" name="file">
	<input type="submit" name="submit" value="Voeg toe">
	</form>
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
	$date = $_POST['datum'];
	$waarde = $_POST['prijs'];
	
	if($_FILES['file']['error'] == 4 ){
		$stmt = $conn->prepare("INSERT INTO IA_Telefoon (U_ID, Telefoonnummer, Merk, Model, Aanschaf_dat, Aanschaf_waarde, Picture_gsm)
											VALUES (?,?,?,?,?,?,?)");
		$stmt->execute([$userid, $nummer, $merk, $model, $date, $waarde, NULL]);
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
						$stmt = $conn->prepare("INSERT INTO IA_Telefoon (U_ID, Telefoonnummer, Merk, Model, Aanschaf_dat, Aanschaf_waarde, Picture_gsm)
												VALUES (?,?,?,?,?,?,?)");
						$stmt->execute([$userid, $nummer, $merk, $model, $date, $waarde, $img]);
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