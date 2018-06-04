<?php 
error_reporting(E_ALL); ini_set('display_errors', 1);
include ("../includes/connection.php");



if(isset($_POST['submit']))
{
$id = $_POST['view'];
$opmerk = $_POST['comment'];	

if(empty($opmerk)){
$sql = "UPDATE IA_Devices
	  SET Opmerkingen = NULL
	  WHERE Dev_ID = :id";
$query = $conn->prepare($sql);
$query->bindparam(":id", $id);
$query->execute();

$conn = null;
echo '<meta http-equiv="refresh" content="0;URL=https://portal.basrt.eu/inventadmin/view.php?view='.$id.'" />';
}
else{
$sql = "UPDATE IA_Devices
	  SET Opmerkingen = :comm
	  WHERE Dev_ID = :id";
$query = $conn->prepare($sql);
$query->bindparam(":comm", $opmerk);
$query->bindparam(":id", $id);
$query->execute();

$conn = null;
echo '<meta http-equiv="refresh" content="0;URL=https://portal.basrt.eu/inventadmin/view.php?view='.$id.'" />';
}	

}
?>
