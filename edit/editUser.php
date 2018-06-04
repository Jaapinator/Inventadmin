<html><head><link rel="icon" sizes="32x32" type="image/png" href="../favicon.ico"/><title>Inventadmin</title>
<meta http-equiv="X-UA-Compatible" content="IE=edge;" /><?php
error_reporting(E_ALL); ini_set('display_errors', 1);
	include "../includes/connection.php";
	include "../includes/scripts.php";?>
<style>
input, select{
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

<?php
	$id = $_GET['edit'];
	
	$sql = "SELECT Dev_ID  as ID, Ruimte_ID as RuID, (SELECT Barcode FROM IA_Devices WHERE IA_Locatie_RG.Dev_ID=IA_Devices.Dev_ID) as Bar, (SELECT Ruimte_naam FROM IA_Locatie WHERE IA_Locatie_RG.Ruimte_ID=IA_Locatie.Ruimte_ID) as RID, (SELECT Gebruiker FROM IA_Gebruiker WHERE IA_Locatie_RG.U_ID=IA_Gebruiker.U_ID) as Geb, (SELECT Mailadres FROM IA_Gebruiker WHERE IA_Locatie_RG.U_ID=IA_Gebruiker.U_ID) as Mail FROM IA_Locatie_RG WHERE U_ID = :id ";
	$query = $conn->prepare($sql);
	$query->execute(array(':id' => $id));

	while($row = $query->fetch(PDO::FETCH_ASSOC))
	{
	$barcode = $row['Bar'];
	$Dev_ID = $row['ID'];
	$ruimte_id = $row['RuID'];
    $user = $row['Geb'];
    $mail = $row['Mail'];
	$rnaam = $row['RID'];
	}
	
	
?> 
<body>
	<div class="container">
	<div class="main-login main-center">
		<H4>Gebruiker</H4>
		<hr>
		<form name="form1" method="post" action="editUser.php?edit=<?php $id; ?>">
		<div class="form-group">
		<label class="control-label col-sm-2" for="Dev_ID">Computer barcode:</label>
			<div class="col-sm-10">
			<?php $sql = $conn->query("SELECT Dev_ID, Barcode FROM IA_Devices"); ?>
			
					<select  name="Dev_ID">
					<option value="<?php echo $Dev_ID; ?>" selected><?php echo $barcode ?></option>
					<option value=""> Geen computer</option>
			<?php	while ($row = $sql->fetch(PDO::FETCH_ASSOC)) {
					   echo '<option value="'.$row['Dev_ID'].'">'.$row['Barcode'].'</option>';
					}?>
					</select>
			</div>
		</div>
		<div class="form-group">
		<label class="control-label col-sm-2" for="ruimte_id">Ruimte:</label>
			<div class="col-sm-10">
			<?php $sql = $conn->query("SELECT Ruimte_naam, Ruimte_ID FROM IA_Locatie"); ?>
			
					<select  name="ruimte_id" required>
					<option value="<?php echo $ruimte_id; ?>" selected><?php echo $rnaam ?></option><?php
					while ($row = $sql->fetch(PDO::FETCH_ASSOC)) {
					   echo '<option value="'.$row['Ruimte_ID'].'">'.$row['Ruimte_naam'].'</option>';
					}?>
					</select>
			</div>
		</div>
		<div class="form-group">
			<label class="control-label col-sm-2" for="user">Gebruikersnaam:</label>
			<div class="col-sm-10">
				<input type='text' name='user' value='<?php echo $user;?>' class='form-control' required>
			</div>
		</div>
		<div class="form-group">
			<label class="control-label col-sm-2" for="mail">E-mail:</label>
			<div class="col-sm-10">
				<input type='text' name='mail' value='<?php echo $mail;?>' class='form-control' required>
			</div>
		</div>
			<input type="hidden" name="id" value="<?php echo $_GET['edit'];?>">
			<input type="submit" name="update" value="Update" class='btn btn-success'>
		</form>
	</div>
	</div>
</body>
</html>
<?php
if(isset($_POST['update']))
{    
    $id = $_POST['id'];
    
    $Dev_ID = $_POST['Dev_ID'];
    $ruimte_id = $_POST['ruimte_id'];
    $user = trim($_POST['user']);    
    $mail = trim($_POST['mail']);     
	
    if(empty($ruimte_id) || empty($user) || empty($mail)) {    

        if(empty($ruimte_id)) {
            echo "<font color='red'>Ruimte niet ingevuld.</font><br/>";
        }
        if(empty($user)) {
            echo "<font color='red'>Gebruikersnaam niet ingevuld.</font><br/>";
        }      
		if(empty($mail)) {
            echo "<font color='red'>E-mail niet ingevuld.</font><br/>";
        } 
    } else {    
		if($Dev_ID == 0){
			//updating the table
			
			$sql = "UPDATE IA_Locatie_RG
					SET Dev_ID = NULL,
					Ruimte_ID = :ruimte_id
					WHERE U_ID = :id";
					 
			$query = $conn->prepare($sql);
			$query->bindparam(':ruimte_id', $ruimte_id);
			$query->bindparam(':id', $id);
			$query->execute();
			
			$sql2 = "UPDATE IA_Gebruiker
					SET Gebruiker = :naam,
					Mailadres = :mail
					WHERE U_ID = :id";
					 
			$query = $conn->prepare($sql2);
			$query->bindparam(':naam', $user);
			$query->bindparam(':mail', $mail);
			$query->bindparam(':id', $id);
			$query->execute();
			
			echo '<meta http-equiv="refresh" content="0;URL=https://portal.basrt.eu/inventadmin/" />';
		}else{
			$sql = "UPDATE IA_Locatie_RG
					SET Dev_ID = :Dev_ID,
					Ruimte_ID = :ruimte_id
					WHERE U_ID = :id";
					 
			$query = $conn->prepare($sql);
			$query->bindparam(':Dev_ID', $Dev_ID);
			$query->bindparam(':ruimte_id', $ruimte_id);
			$query->bindparam(':id', $id);
			$query->execute();
			
			$sql2 = "UPDATE IA_Gebruiker
					SET Gebruiker = :naam,
					Mailadres = :mail
					WHERE U_ID = :id";
					 
			$query = $conn->prepare($sql2);
			$query->bindparam(':naam', $user);
			$query->bindparam(':mail', $mail);
			$query->bindparam(':id', $id);
			$query->execute();
			
					
			echo '<meta http-equiv="refresh" content="0;URL=https://portal.basrt.eu/inventadmin/" />';
		}
		$conn = null;
		} 
}
?>
