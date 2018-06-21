<?php
error_reporting(E_ALL); ini_set('display_errors', 1);

include "includes/connection.php";

if(isset($_POST['submit'])){

$tabel = $_POST['tabel'];
$date1 = $_POST['date1'];
$date2 = $_POST['date2'];

echo $tabel;

if($tabel == "IA_Devices"){$sql = "SELECT Barcode, Naam, Ip_adres, Merk, Model, CPU, Memory, Moederbord, Serialnummer, Aanschaf_dat, Aanschaf_waarde FROM IA_Devices WHERE Aanschaf_dat BETWEEN '$date1' AND '$date2'";}
else{$sql = "SELECT * FROM $tabel  WHERE Aanschaf_dat BETWEEN '$date1' AND '$date2'"; }
$query = $conn->prepare($sql);
$query->execute();
$rows = $query->fetchAll(PDO::FETCH_ASSOC);
 
$columnNames = array();
if(!empty($rows)){
    $firstRow = $rows[0];
    foreach($firstRow as $colName => $val){
        $columnNames[] = $colName;
    }
}
 
$fileName = 'export-'.date('Y-m-d H.i.s').'.csv';
 
header('Content-Type: application/excel');
header('Content-Disposition: attachment; filename="' . $fileName . '"');

$fp = fopen('php://output', 'w');
 
fputcsv($fp, $columnNames, ';', ' ');
 
foreach ($rows as $row) {
    fputcsv($fp, $row, ';', ' ');
}

fclose($fp);
}
?>
