<?php
include ('../../Connect.php');
require '../../vendor/autoload.php';
session_start();

if ($conn) {
  $awal = "";
  $query = "SELECT * FROM penjualan";
  $result = $conn->query($query);
  $buys = $result->fetch_all(MYSQLI_BOTH);
}
// var_dump($result);
ob_start();
?>

<?= include '../../pages/laporan/pdf/penjualan.php' ?>

<?php
    $html = ob_get_clean();
    $title = "Laporan Penjualan - ".date("d-m-Y");

    use Dompdf\Dompdf;
    $document = new Dompdf();
    $document->loadHtml($html);
    $document->setPaper('A4', 'lanscape');
    $document->render();
    $document->stream('Eoq', array("Attachment"=>0));
?>
