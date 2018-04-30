<html><head><link rel="icon" sizes="32x32" type="image/png" href="../favicon.ico"/><title>Inventadmin</title>
<meta http-equiv="X-UA-Compatible" content="IE=edge;" /><?php
error_reporting(E_ALL); ini_set('display_errors', 1);
	include "../includes/connection.php";
?><style><?php
	include "../includes/css/style.css";
?></style>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
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
<div class='navbar'>
	<a href='https://portal.basrt.eu/index/login.php'>Portal</a>
	<a href='../index.php'>Overzicht</a>
</div>

<?php
	$id = $_GET['edit'];
	
	$sql = "SELECT * FROM IA_Telefoon WHERE Gsm_ID=:id";
	$query = $conn->prepare($sql);
	$query->execute(array(':id' => $id));

	while($row = $query->fetch(PDO::FETCH_ASSOC))
	{
    $nummer = $row['Telefoonnummer'];
    $merk = $row['Merk'];
    $model = $row['Model'];
    $datum = $row['Aanschaf_dat'];
    $waarde = $row['Aanschaf_waarde'];
	$deleteimg = $row['Picture_gsm'];
	
	$newDate = date("Y-m-d", strtotime($datum));
	}
	
	
?> 
<body>
	<div class="form">
		<H4>Telefoon</H4>
		<label>Gebruiker</label>
			<form name="form1" method="post" action="editGsm.php?edit=<?php $id; ?>" enctype="multipart/form-data">
			<?php $sql = $conn->query("SELECT U_ID, Gebruiker FROM IA_Gebruiker"); 
			
					echo '<select  name="userid" required>'; 
					while ($row = $sql->fetch(PDO::FETCH_ASSOC)) {
					   echo '<option value="'.$row['U_ID'].'">'.$row['Gebruiker'].'</option>';
					}
					echo '</select>';?>
		<label>Telefoonnummer</label>
			<input type="text" name="nummer"  value="<?php echo $nummer;?>">
		<label>Merk</label>
			<input type="text" name="merk" value="<?php echo $merk;?>">
		<label>Model</label>
			<input type="text" name="model"  value="<?php echo $model;?>">
		<label>Aanschaf datum</label>
			<input type="date" id="picker" name="date" value="<?php echo $newDate;?>">
		<label>Aanschaf waarde</label>
			<input type="text" name="waarde" value="<?php echo $waarde;?>">
		<label>Foto telefoon</label>
		<br>
			<input type="file" name="file">
			<input type="hidden" name="id" value="<?php echo $_GET['edit'];?>">
			<input type="submit" name="update" value="Update">
		</form>
	</div>
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
    $datum = trim($_POST['date']);    
    $waarde = trim($_POST['waarde']);    
	
	$sql = "SELECT * FROM IA_Telefoon WHERE Gsm_ID=:id";
	$query = $conn->prepare($sql);
	$query->execute(array(':id' => $id));
	
	while($row = $query->fetch(PDO::FETCH_ASSOC))
	{
    $deleteimg = $row['Picture_gsm'];
	}
	
    if(empty($userid) || empty($nummer) || empty($merk) || empty($model) || empty($datum) || empty($waarde)) {    
            
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
							Aanschaf_dat = :datum, 
							Aanschaf_waarde = :waarde,
							Picture_gsm = NULL
					  WHERE Gsm_ID = :id";
					 
			$query = $conn->prepare($sql);
			$query->bindparam(":userid", $userid);
			$query->bindparam(':nummer', $nummer);
			$query->bindparam(':merk', $merk);
			$query->bindparam(':model', $model);
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
											Aanschaf_dat = :datum, 
											Aanschaf_waarde = :waarde,
											Picture_gsm = :pic
									  WHERE Gsm_ID = :id";
									 
							$query = $conn->prepare($sql);
							$query->bindparam(":userid", $userid);
							$query->bindparam(':nummer', $nummer);
							$query->bindparam(':merk', $merk);
							$query->bindparam(':model', $model);
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
