<html><head><link rel="icon" sizes="32x32" type="image/png" href="../favicon.ico"/><title>Inventadmin</title>
<meta http-equiv="X-UA-Compatible" content="IE=edge;" /><?php
error_reporting(E_ALL); ini_set('display_errors', 1);
	include "../includes/connection.php";
?><style><?php
	include "../includes/css/style.css";
?></style>
<div class='navbar'>
	<a href='https://portal.basrt.eu/index/login.php'>Portal</a>
	<a href='../index.php'>Overzicht</a>
</div>

<?php
	$id = $_GET['edit'];
	
	$sql = "SELECT IA_Gebruiker.Com_ID, IA_Gebruiker.Ruimte_ID, IA_Gebruiker.Gebruiker, IA_Gebruiker.Mailadres, IA_Computer.Barcode, Ruimte_naam FROM IA_Gebruiker, IA_Computer, IA_Locatie WHERE U_ID=:id AND IA_Computer.Com_ID=IA_Gebruiker.Com_ID AND IA_Gebruiker.Ruimte_ID=IA_Locatie.Ruimte_ID";
	$query = $conn->prepare($sql);
	$query->execute(array(':id' => $id));

	while($row = $query->fetch(PDO::FETCH_ASSOC))
	{
	$barcode = $row['Barcode'];
	$com_id = $row['Com_ID'];
	$ruimte_id = $row['Ruimte_ID'];
    $user = $row['Gebruiker'];
    $mail = $row['Mailadres'];
	$rnaam = $row['Ruimte_naam'];
	}
	
	
?> 
<body>
	<div class="form">
		<H4>Gebruiker</H4>
		<form name="form1" method="post" action="editUser.php?edit=<?php $id; ?>">
		<label>Computer barcode</label>
			<?php $sql = $conn->query("SELECT Barcode, Com_ID FROM IA_Computer WHERE Barcode<>$barcode"); ?>
			
					<select  name="com_id" required>
					<option value="<?php echo $com_id; ?>" selected><?php echo $barcode ?></option><?php
					while ($row = $sql->fetch(PDO::FETCH_ASSOC)) {
					   echo '<option value="'.$row['Com_ID'].'">'.$row['Barcode'].'</option>';
					}?>
					</select>
		<label>Ruimte</label>
			<?php $sql = $conn->query("SELECT Ruimte_naam, Ruimte_ID FROM IA_Locatie WHERE Ruimte_ID<>$ruimte_id"); ?>
			
					<select  name="ruimte_id" required>
					<option value="<?php echo $ruimte_id; ?>" selected><?php echo $rnaam ?></option><?php
					while ($row = $sql->fetch(PDO::FETCH_ASSOC)) {
					   echo '<option value="'.$row['Ruimte_ID'].'">'.$row['Ruimte_naam'].'</option>';
					}?>
					</select>
		<label>Gebruikersnaam</label>
			<input type="text" name="user"  value="<?php echo $user;?>">
		<label>E-mail</label>
			<input type="email" name="mail"  value="<?php echo $mail;?>">
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
    
    $com_id = $_POST['com_id'];
    $ruimte_id = $_POST['ruimte_id'];
    $user = trim($_POST['user']);    
    $mail = trim($_POST['mail']);     
	
    if(empty($com_id) || empty($ruimte_id) || empty($user) || empty($mail)) {    
            
        if(empty($com_id)) {
            echo "<font color='red'>Barcode niet ingevuld.</font><br/>";
        }
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
        //updating the table
        $sql = "UPDATE IA_Gebruiker
					SET Com_ID = :com_id,
						Ruimte_ID = :ruimte_id, 
						Gebruiker = :naam, 
						Mailadres = :mail
				  WHERE U_ID = :id";
				 
		$query = $conn->prepare($sql);
		$query->bindparam(":com_id", $com_id);
		$query->bindparam(':ruimte_id', $ruimte_id);
		$query->bindparam(':naam', $user);
		$query->bindparam(':mail', $mail);
		$query->bindparam(':id', $id);
		$query->execute();
		
		$conn = null;
		
		echo '<meta http-equiv="refresh" content="0;URL=https://portal.basrt.eu/inventadmin/" />';
		} 
}
?>
