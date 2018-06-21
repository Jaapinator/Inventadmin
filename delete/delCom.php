<p style="color:red;">Hij kon de computer niet verwijderen omdat er nog monitors, software of een gebruiker aan gekoppeld waren. Klik <a href='../index.php'>hier</a> om terug te gaan naar het overzicht.</p>
<?php
	include "../includes/connection.php";
?><style><?php
	include "../includes/style.css";
?></style><?php	
		
		$Dev_ID = $_REQUEST['edit'];
		
			$sql = "SELECT * FROM IA_Devices WHERE Dev_ID=:id";
			$query = $conn->prepare($sql);
			$query->execute(array(':id' => $Dev_ID));
			
			while($row = $query->fetch(PDO::FETCH_ASSOC))
			{
			$deleteimg = $row['Picture_Dev'];
			}
			
		try{
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "DELETE FROM IA_Devices WHERE Dev_ID = $Dev_ID";
		$conn->query($sql);
		unlink('//WEBSERVER03/Portal$/inventadmin/'.$deleteimg);
		echo '<meta http-equiv="refresh" content="0;URL=https://portal.basrt.eu/inventadmin/" />';
		}
		catch(PDOException $e)
		{
			echo $sql . "<br>" . $e->getMessage();
		}
	
		$conn = null;
	
?>
