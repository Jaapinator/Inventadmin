<p style="color:red;">Hij kon de computer niet verwijderen omdat er nog monitors, software of een gebruiker aan gekoppeld waren. Klik <a href='../index.php'>hier</a> om terug te gaan naar het overzicht.</p>
<?php
	include "../includes/connection.php";
?><style><?php
	include "../includes/style.css";
?></style><?php	
		
		$lap_id = $_REQUEST['edit'];
		
			$sql = "SELECT * FROM IA_Laptop WHERE Lap_ID=:id";
			$query = $conn->prepare($sql);
			$query->execute(array(':id' => $lap_id));
			
			while($row = $query->fetch(PDO::FETCH_ASSOC))
			{
			$deleteimg = $row['Picture_lap'];
			}
		try{
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "DELETE FROM IA_Laptop WHERE Lap_ID = $lap_id";
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