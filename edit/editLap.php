<html><head><link rel="icon" sizes="32x32" type="image/png" href="../favicon.ico"/><title>Inventadmin</title>
<meta http-equiv="X-UA-Compatible" content="IE=edge;" /><?php
error_reporting(E_ALL); ini_set('display_errors', 1);
	include "../includes/connection.php";
	include "../includes/scripts.php";?>
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
	
	$sql = "SELECT * FROM IA_Laptop, IA_Gebruiker WHERE Lap_ID=:id AND IA_Gebruiker.U_ID=IA_Laptop.U_ID";
	$query = $conn->prepare($sql);
	$query->execute(array(':id' => $id));

	while($row = $query->fetch(PDO::FETCH_ASSOC))
	{
    $merk = $row['Merk'];
    $barcode = $row['Barcode'];
    $name = $row['Lap_naam'];
    $cpu = $row['CPU'];
    $memory = $row['Memory'];
    $inch = $row['Inch'];
    $datum = $row['Aanschaf_dat'];
    $waarde = $row['Aanschaf_waarde'];
    $opmerk = $row['Opmerkingen'];
	$user_id = $row['U_ID'];
	$gebruiker = $row['Gebruiker'];
	
	$newDate = date("Y-m-d", strtotime($datum));
	}
	
	
?> 
<body>
	<div class="form">
		<H4>Laptop</H4>
		<label>Gebruiker</label>
			<form name="form1" method="post" action="editLap.php?edit=<?php $id; ?>" enctype="multipart/form-data">
			<?php $sql = $conn->query("SELECT U_ID, Gebruiker FROM IA_Gebruiker"); ?>
			
				<select  name="userid" required>
				<option value="<?php echo $user_id; ?>" selected><?php echo $gebruiker ?></option>
		<?php 	while ($row = $sql->fetch(PDO::FETCH_ASSOC)) {
				   echo '<option value="'.$row['U_ID'].'">'.$row['Gebruiker'].'</option>';
				} ?>
				</select>
		<label>Barcode</label>
			<input type="text" name="barcode" value="<?php echo $barcode;?>">
		<label>Naam</label>
			<input type="text" name="name" value="<?php echo $name;?>">
		<label>Merk</label>
			<input type="text" name="merk" value="<?php echo $merk;?>">
		<label>CPU</label>
			<input type="text" name="cpu"  value="<?php echo $cpu;?>">
		<label>Memory</label>
			<input type="text" name="memory"  value="<?php echo $memory;?>">
		<label>Inch</label>
			<input type="text" name="inch"  value="<?php echo $inch;?>">
		<label>Aanschaf datum</label>
			<input type="date" id="picker" name="date" value="<?php echo $newDate;?>">
		<label>Aanschaf waarde</label>
			<input type="text" name="waarde" value="<?php echo $waarde;?>">
		<label>Opmerkingen</label>
		<br>
			<input type="text" name="opmerk" value="<?php echo $opmerk;?>">
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
    $barcode = trim($_POST['barcode']);
    $name = trim($_POST['name']);
    $merk = trim($_POST['merk']);
    $cpu = trim($_POST['cpu']);
    $memory = trim($_POST['memory']);    
    $inch = trim($_POST['inch']);    
    $datum = trim($_POST['date']);    
    $waarde = trim($_POST['waarde']);    
    $opmerk = trim($_POST['opmerk']);      
	
	$sql = "SELECT * FROM IA_Laptop WHERE Lap_ID=:id";
	$query = $conn->prepare($sql);
	$query->execute(array(':id' => $id));
	
	while($row = $query->fetch(PDO::FETCH_ASSOC))
	{
    $deleteimg = $row['Picture_lap'];
	}
	
    if(empty($userid) || empty($barcode) || empty($name) || empty($merk) || empty($cpu) || empty($memory) || empty($inch) || empty($datum) || empty($waarde)) {    
            
        if(empty($userid)) {
            echo "<font color='red'>Gebruiker niet gekozen.</font><br/>";
        }
        if(empty($barcode)) {
            echo "<font color='red'>Barcode niet ingevuld.</font><br/>";
        }
        if(empty($name)) {
            echo "<font color='red'>Naam niet ingevuld.</font><br/>";
        }
        if(empty($merk)) {
            echo "<font color='red'>Merk niet ingevuld.</font><br/>";
        }
        if(empty($cpu)) {
            echo "<font color='red'>CPU niet ingevuld.</font><br/>";
        }      
		if(empty($memory)) {
            echo "<font color='red'>Memory niet ingevuld.</font><br/>";
        } 
		if(empty($inch)) {
            echo "<font color='red'>Inch niet ingevuld.</font><br/>";
        } 
		if(empty($datum)) {
            echo "<font color='red'>Aanschaf datum niet ingevuld.</font><br/>";
        } 
		if(empty($waarde)) {
            echo "<font color='red'>Aanschaf waarde niet ingevuld.</font><br/>";
        } 
    } else {  
		if($_FILES['file']['error'] == 4 ){
			$sql = "UPDATE IA_Laptop
						SET U_ID = :userid,
							Barcode = :barcode, 
							Lap_naam = :name, 
							Merk = :merk, 
							CPU = :cpu, 
							Memory = :memory, 
							Inch = :inch, 
							Aanschaf_dat = :datum, 
							Aanschaf_waarde = :waarde,
							Opmerkingen = :opmerk,
							Picture_lap = NULL
					  WHERE Lap_ID = :id";
					 
			$query = $conn->prepare($sql);
			$query->bindparam(":userid", $userid);
			$query->bindparam(':barcode', $barcode);
			$query->bindparam(':name', $name);
			$query->bindparam(':merk', $merk);
			$query->bindparam(':cpu', $cpu);
			$query->bindparam(':memory', $memory);
			$query->bindparam(':inch', $inch);
			$query->bindparam(':datum', $datum);
			$query->bindparam(':waarde', $waarde);
			$query->bindparam(':opmerk', $opmerk);
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
						$fileDestination = '//WEBSERVER03/Portal$/inventadmin/includes/images/laptop/'.$fileNameNew;
						move_uploaded_file($fileTmpName, $fileDestination);
						try{
							$dir = 'includes/images/laptop/';
							$img = $dir.$fileNameNew;
							$sql = "UPDATE IA_Laptop
										SET U_ID = :userid,
											Barcode = :barcode, 
											Lap_naam = :name, 
											Merk = :merk, 
											CPU = :cpu, 
											Memory = :memory, 
											Inch = :inch, 
											Aanschaf_dat = :datum, 
											Aanschaf_waarde = :waarde,
											Opmerkingen = :opmerk,
											Picture_lap = :pic
									  WHERE Lap_ID = :id";
									 
							$query = $conn->prepare($sql);
							$query->bindparam(":userid", $userid);
							$query->bindparam(':barcode', $barcode);
							$query->bindparam(':name', $name);
							$query->bindparam(':merk', $merk);
							$query->bindparam(':cpu', $cpu);
							$query->bindparam(':memory', $memory);
							$query->bindparam(':inch', $inch);
							$query->bindparam(':datum', $datum);
							$query->bindparam(':waarde', $waarde);
							$query->bindparam(':opmerk', $opmerk);
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
