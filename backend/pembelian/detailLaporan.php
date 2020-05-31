<?php
include ('../../Connect.php');
require '../../vendor/autoload.php';
session_start();

if ($conn) {
  $id = $_GET['id'];
  $query = "
  SELECT
      pembelian.code AS kode,
      pembelian.supplier AS supplier,
      pembelian.tanggal AS tanggal,
      barang.name AS barang,
      barang.harga AS harga,
      pivot_pembelian.total AS total
  FROM pivot_pembelian
  INNER JOIN pembelian ON pivot_pembelian.pembelian_id = pembelian.id
  INNER JOIN barang ON pivot_pembelian.barang_id = barang.id
  WHERE pivot_pembelian.pembelian_id=$id
  ";
  $buys = $conn->query($query);
  
}
$temp = $buys->fetch_all(MYSQLI_BOTH);
ob_start();
?>

<?= include('../../pages/laporan/pdf/pembelian_detail.php') ?>

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

