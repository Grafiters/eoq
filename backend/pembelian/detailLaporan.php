<?php
include ('../../Connect.php');
require '../../vendor/autoload.php';
session_start();

if ($conn) {
  $query = "
  SELECT
      pembelian.code AS kode,
      supplier.name AS supplier,
      barang.name AS barang,
      barang.harga AS harga,
      pivot_pembelian.total AS total,
      pembelian.created_at AS tanggal
  FROM pembelian
  INNER JOIN pivot_pembelian ON pembelian.id = pivot_pembelian.pembelian_id
  INNER JOIN supplier ON pembelian.supplier_id = supplier.id
  INNER JOIN barang ON pivot_pembelian.barang_id = barang.id
  ";
  $buys = $conn->query($query);
}
$temp = $buys->fetch_all(MYSQLI_BOTH);
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
$document->stream($title,array("Attachment"=>0));
?>

