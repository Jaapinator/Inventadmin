<?php 
error_reporting(E_ALL); ini_set('display_errors', 1);

	include ("../includes/connection.php");

if(isset($_POST['update']))
{    
    $id = $_POST['id'];
    
    $barcode = trim($_POST['barcode']);
	$naam = trim($_POST['naam']);
    $merk = trim($_POST['merk']);
    $ip = trim($_POST['ip']);    
    $cpu = trim($_POST['cpu']);    
    $mem = trim($_POST['mem']);    
    $serial = trim($_POST['serial']);    
    $datum = trim($_POST['date']);    
    $waarde = trim($_POST['waarde']);    
	
    if(empty($barcode) || empty($merk) || empty($naam) || empty($ip) || empty($cpu) || empty($mem) || empty($serial) || empty($datum) || empty($waarde)) {    
            
        if(empty($barcode)) {
            echo "<font color='red'>Barcode niet ingevuld.</font><br/>";
        }
		if(empty($naam)) {
            echo "<font color='red'>Computer naam niet ingevuld.</font><br/>";
        }
        if(empty($merk)) {
            echo "<font color='red'>Computer merk niet ingevuld.</font><br/>";
        }
        if(empty($ip)) {
            echo "<font color='red'>Ip-adres niet ingevuld.</font><br/>";
        }      
		if(empty($cpu)) {
            echo "<font color='red'>CPU niet ingevuld.</font><br/>";
        } 
		if(empty($mem)) {
            echo "<font color='red'>Ram niet ingevuld.</font><br/>";
        } 
		if(empty($serial)) {
            echo "<font color='red'>Serienummer niet ingevuld.</font><br/>";
        } 
		if(empty($datum)) {
            echo "<font color='red'>Aanschaf datum niet ingevuld.</font><br/>";
        } 
		if(empty($waarde)) {
            echo "<font color='red'>Aanschaf waarde niet ingevuld.</font><br/>";
        } 
    } else {    
        //updating the table
        $sql = "UPDATE IA_Computer
					SET Barcode = :barcode,
						Com_naam = :naam,
						Ip_adres = :ip, 
						Com_merk = :merk, 
						CPU_naam = :cpu, 
						Memory = :mem,  
						Serialnum = :serial, 
						Aanschaf_dat = :datum, 
						Aanschaf_waarde = :waarde 
				  WHERE Com_ID = :id";
				 
		$query = $conn->prepare($sql);
		$query->bindparam(":barcode", $barcode);
		$query->bindparam(':naam', $naam);
		$query->bindparam(':ip', $ip);
		$query->bindparam(':merk', $merk);
		$query->bindparam(':cpu', $cpu);
		$query->bindparam(':mem', $mem);
		$query->bindparam(':serial', $serial);
		$query->bindparam(':datum', $datum);
		$query->bindparam(':waarde', $waarde);
		$query->bindparam(':id', $id);
		$query->execute();
		
		$conn = null;
		
		echo '<meta http-equiv="refresh" content="0;URL=http://webserver03/inventadmin/" />';
		} 
}
?>
