<?php
include('../../Connect.php');
require '../../vendor/autoload.php';

if ($conn) {
  $query = "
    SELECT
      pivot.id AS id,
      penjualan.code AS kode,
      penjualan.created_at AS tanggal,
      barang.harga * pivot.total AS bayar
    FROM barang, penjualan, pivot
    WHERE barang.id=penjualan.id=pivot.id
  ";
  $buys = $conn->query($query);
}
ob_start();
?>

<?= include('../../pages/laporan/pdf/pembelian.php') ?>

<?php

$html = ob_get_clean();
$title = "Laporan Pembelian - ".date("d-m-Y");

use Dompdf\Dompdf;

$document = new Dompdf();
$document->loadHtml($html);
$document->setPaper('A4', 'portrait');
$document->render();
$document->stream($title);
?>
