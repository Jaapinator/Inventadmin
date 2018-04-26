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
	<H4>Tablet</H4>
	<form method="post" action="insertTabForm.php" enctype="multipart/form-data" id="tab_form">
	<?php
	$sql = $conn->query("SELECT U_ID, Gebruiker FROM IA_Gebruiker ORDER BY Gebruiker"); 
					
					echo "<label>Gebruiker</label>";
					echo '<select  name="user" required>'; 
					echo '<option style="display:none" value="">Kies gebruiker van de tablet</option>';
					while ($row = $sql->fetch(PDO::FETCH_ASSOC)) {
					   echo '<option value="'.$row['U_ID'].'">'.$row['Gebruiker'].'</option>';
					}
					echo '</select>';
					?>
	<label>Merk</label>
	<input type="text" name="merk" placeholder="Merk" required>
	<label>Model</label>
	<input type="text" name="model" placeholder="Model" required>
	<label>Inch</label>
	<input type="text" name="inch" placeholder="Inch" required>
	<label>Opslagcapaciteit</label>
	<input type="text" name="opslag" placeholder="Opslagcapaciteit" required>
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
	$inch = $_POST['inch'];
	$merk = $_POST['merk'];
	$model = $_POST['model'];
	$opslag = $_POST['opslag'];
	$date = $_POST['datum'];
	$waarde = $_POST['prijs'];
	
	if($_FILES['file']['error'] == 4){
		$stmt = $conn->prepare("INSERT INTO IA_Tablet (U_ID, Merk, Model, Inch, Opslagcapaciteit, Aanschaf_dat, Aanschaf_waarde, Picture_tab)
												VALUES (?,?,?,?,?,?,?,?)");
		$stmt->execute([$userid, $merk, $model, $inch, $opslag, $date, $waarde, NULL]);
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
					$fileDestination = '//WEBSERVER03/Portal$/inventadmin/includes/images/tablet/'.$fileNameNew;
					move_uploaded_file($fileTmpName, $fileDestination);
					try{
						$dir = 'includes/images/tablet/';
						$img = $dir.$fileNameNew;
						$stmt = $conn->prepare("INSERT INTO IA_Tablet (U_ID, Merk, Model, Inch, Opslagcapaciteit, Aanschaf_dat, Aanschaf_waarde, Picture_tab)
												VALUES (?,?,?,?,?,?,?,?)");
						$stmt->execute([$userid, $merk, $model, $inch, $opslag, $date, $waarde, $img]);
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