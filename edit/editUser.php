<html><head><link rel="icon" sizes="32x32" type="image/png" href="../favicon.ico"/><title>Inventadmin</title>
<meta http-equiv="X-UA-Compatible" content="IE=edge;" /><?php
error_reporting(E_ALL); ini_set('display_errors', 1);
	include "../includes/connection.php";
	include "../includes/scripts.php";?>
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
	
	$sql = "SELECT IA_Locatie_RG.Com_ID, IA_Locatie_RG.Ruimte_ID, IA_Gebruiker.Gebruiker, IA_Gebruiker.Mailadres, IA_Computer.Barcode, Ruimte_naam FROM IA_Gebruiker, IA_Computer, IA_Locatie, IA_Locatie_RG WHERE IA_Gebruiker.U_ID=:id AND IA_Computer.Com_ID=IA_Locatie_RG.Com_ID AND IA_Locatie_RG.Ruimte_ID=IA_Locatie.Ruimte_ID AND IA_Gebruiker.U_ID=IA_Locatie_RG.U_ID";
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
