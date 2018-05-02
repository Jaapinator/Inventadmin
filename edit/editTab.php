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
	
	$sql = "SELECT * FROM IA_Tablet, IA_Gebruiker WHERE Tab_ID=:id AND IA_Gebruiker.U_ID=IA_Tablet.U_ID";
	$query = $conn->prepare($sql);
	$query->execute(array(':id' => $id));

	while($row = $query->fetch(PDO::FETCH_ASSOC))
	{
    $merk = $row['Merk'];
    $model = $row['Model'];
    $inch = $row['Inch'];
    $opslag = $row['Opslagcapaciteit'];
    $datum = $row['Aanschaf_dat'];
    $waarde = $row['Aanschaf_waarde'];
	$user_id = $row['U_ID'];
	$gebruiker = $row['Gebruiker'];
	
	$newDate = date("Y-m-d", strtotime($datum));
	}
	
	
?> 
<body>
	<div class="form">
		<H4>Tablet</H4>
		<label>Gebruiker</label>
			<form name="form1" method="post" action="editTab.php?edit=<?php $id; ?>" enctype="multipart/form-data">
			<?php $sql = $conn->query("SELECT U_ID, Gebruiker FROM IA_Gebruiker"); ?>
			
				<select  name="userid" required>
				<option value="<?php echo $user_id; ?>" selected><?php echo $gebruiker ?></option>
		<?php 	while ($row = $sql->fetch(PDO::FETCH_ASSOC)) {
				   echo '<option value="'.$row['U_ID'].'">'.$row['Gebruiker'].'</option>';
				} ?>
				</select>
		<label>Merk</label>
			<input type="text" name="merk" value="<?php echo $merk;?>">
		<label>Model</label>
			<input type="text" name="model"  value="<?php echo $model;?>">
		<label>Inch</label>
			<input type="text" name="inch"  value="<?php echo $inch;?>">
		<label>Opslagcapaciteit</label>
			<input type="text" name="opslag"  value="<?php echo $opslag;?>">
		<label>Aanschaf datum</label>
			<input type="date" id="picker" name="date" value="<?php echo $newDate;?>">
		<label>Aanschaf waarde</label>
			<input type="text" name="waarde" value="<?php echo $waarde;?>">
		<br>
		<label>Foto Tablet</label>
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
    $merk = trim($_POST['merk']);
    $model = trim($_POST['model']);
    $inch = trim($_POST['inch']);    
    $opslag = trim($_POST['opslag']);    
    $datum = trim($_POST['date']);    
    $waarde = trim($_POST['waarde']);     
	
	$sql = "SELECT * FROM IA_Tablet WHERE Tab_ID=:id";
	$query = $conn->prepare($sql);
	$query->execute(array(':id' => $id));
	
	while($row = $query->fetch(PDO::FETCH_ASSOC))
	{
    $deleteimg = $row['Picture_tab'];
	}
	
    if(empty($userid) || empty($merk) || empty($model) || empty($inch) || empty($opslag) || empty($datum) || empty($waarde)) {    
            
        if(empty($userid)) {
            echo "<font color='red'>Gebruiker niet gekozen.</font><br/>";
        }
        if(empty($merk)) {
            echo "<font color='red'>Merk niet ingevuld.</font><br/>";
        }
        if(empty($model)) {
            echo "<font color='red'>Model niet ingevuld.</font><br/>";
        }      
		if(empty($inch)) {
            echo "<font color='red'>Inch niet ingevuld.</font><br/>";
        } 
		if(empty($opslag)) {
            echo "<font color='red'>Opslag niet ingevuld.</font><br/>";
        } 
		if(empty($datum)) {
            echo "<font color='red'>Aanschaf datum niet ingevuld.</font><br/>";
        } 
		if(empty($waarde)) {
            echo "<font color='red'>Aanschaf waarde niet ingevuld.</font><br/>";
        } 
    } else {  
		if($_FILES['file']['error'] == 4 ){
			$sql = "UPDATE IA_Tablet
						SET U_ID = :userid,
							Merk = :merk, 
							Model = :model,  
							Inch = :inch, 
							Opslagcapaciteit = :opslag, 
							Aanschaf_dat = :datum, 
							Aanschaf_waarde = :waarde,
							Picture_tab = NULL
					  WHERE Tab_ID = :id";
					 
			$query = $conn->prepare($sql);
			$query->bindparam(":userid", $userid);
			$query->bindparam(':merk', $merk);
			$query->bindparam(':model', $model);
			$query->bindparam(':inch', $inch);
			$query->bindparam(':opslag', $opslag);
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
						$fileDestination = '//WEBSERVER03/Portal$/inventadmin/includes/images/tablet/'.$fileNameNew;
						move_uploaded_file($fileTmpName, $fileDestination);
						try{
							$dir = 'includes/images/tablet/';
							$img = $dir.$fileNameNew;
							$sql = "UPDATE IA_Tablet
										SET U_ID = :userid,
											Merk = :merk, 
											Model = :model,  
											Inch = :inch, 
											Opslagcapaciteit = :opslag, 
											Aanschaf_dat = :datum, 
											Aanschaf_waarde = :waarde,
											Picture_tab = :pic
									  WHERE Tab_ID = :id";
									 
							$query = $conn->prepare($sql);
							$query->bindparam(":userid", $userid);
							$query->bindparam(':merk', $merk);
							$query->bindparam(':model', $model);
							$query->bindparam(':inch', $inch);
							$query->bindparam(':opslag', $opslag);
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
