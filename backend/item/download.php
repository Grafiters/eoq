<?php
include ('../../Connect.php');
require '../../vendor/autoload.php';
session_start();

if ($conn) {
  $query = "SELECT * FROM barang";
  $buys = $conn->query($query);
}
$stocks = $buys->fetch_all(MYSQLI_BOTH);
ob_start();
?>

<?= include('../../pages/laporan/pdf/stock.php') ?>

<?php

$html = ob_get_clean();
$title = "Laporan Pembelian - ".date("d-m-Y");

use Dompdf\Dompdf;

$document = new Dompdf();
$document->loadHtml($html);
$document->setPaper('A4', 'portrait');
$document->render();
$document->stream($title,array("Attachment"=>0));
?>

