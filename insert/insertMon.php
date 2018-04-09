<?php
error_reporting(E_ALL); ini_set('display_errors', 1);
	include "../includes/connection.php";
?><style><?php
	//include "../includes/style.css";
?></style><script>
<?php include "../addMon.js"; ?>
</script><?php
	
if (isset($_POST['com_id'])) { 
    //id
    $com_id = $_POST['com_id'];
    //array
    $mon_barcode = $_POST['mon_barcode'];
    $mon_merk = $_POST['mon_merk'];
    $mon_type = $_POST['mon_type'];
    $mon_inch = $_POST['mon_inch'];
    $mon_a_date = $_POST['mon_a_date'];
    $mon_a_prijs = $_POST['mon_a_prijs'];

    $sql = "INSERT INTO IA_Monitor (Com_ID, Barcode, Merk, Type, Inch, Aanschaf_dat, Aanschaf_waarde) VALUES (?,?,?,?,?,?,?)";
    try {
        $stmt = $conn->prepare($sql);
        foreach ($mon_barcode as $i => $barcode) {
            $stmt->execute([$com_id, $barcode, $mon_merk[$i], $mon_type[$i], $mon_inch[$i], $mon_a_date[$i], $mon_a_prijs[$i]]);
			echo '<meta http-equiv="refresh" content="0;URL=https://portal.basrt.eu/inventadmin/" />';
        }
    } catch (\PDOException $e) {
    //    echo $sql . "<br>" . $e->getMessage();
	echo "<script>alert('Vul de velden goed in!');</script>";
	echo '<meta http-equiv="refresh" content="0;URL=https://portal.basrt.eu/inventadmin/insert/insertMonForm.php" />';
    }
}
$conn = null;




?>
