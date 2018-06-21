<p style="color:red;">Hij kon de telefoon niet verwijderen omdat er nog monitors, software of een gebruiker aan gekoppeld waren. Klik <a href='../index.php'>hier</a> om terug te gaan naar het overzicht.</p>
<?php
	include "../includes/connection.php";
?><style><?php
	include "../includes/style.css";
?></style><?php	
		
		$gsm_id = $_REQUEST['edit'];
		
			$sql = "SELECT * FROM IA_Telefoon WHERE Gsm_ID=:id";
			$query = $conn->prepare($sql);
			$query->execute(array(':id' => $gsm_id));
			
			while($row = $query->fetch(PDO::FETCH_ASSOC))
			{
			$deleteimg = $row['Picture_gsm'];
			}
		try{
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "DELETE FROM IA_Telefoon WHERE Gsm_ID = $gsm_id";
		$conn->exec($sql);
		unlink('//WEBSERVER03/Portal$/inventadmin/'.$deleteimg);
		echo '<meta http-equiv="refresh" content="0;URL=https://portal.basrt.eu/inventadmin/" />';
		}
		catch(PDOException $e)
		{
			echo $sql . "<br>" . $e->getMessage();
		}
	
		$conn = null;
	
?>
