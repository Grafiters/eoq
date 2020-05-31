<?php
include ('../../Connect.php');
require '../../vendor/autoload.php';
session_start();

if ($conn) {
  $id = $_GET['id'];
  $query = "
  SELECT
      retur.kode,
      supplier.name AS supplier,
      retur.tanggal,
      barang.name AS barang,
      barang.harga,
      pr.status,
      pr.total
  FROM pivot_retur pr
  INNER JOIN retur ON pr.retur_id = retur.id
  INNER JOIN barang ON pr.barang_id = barang.id
  INNER JOIN supplier ON retur.supplier_id = supplier.id
  WHERE pr.retur_id=$id
  ";
  $buys = $conn->query($query);

}
$temp = $buys->fetch_all(MYSQLI_BOTH);
ob_start();
?>

<?= include('../../pages/retur/pdf.php') ?>

<?php

$html = ob_get_clean();
$title = "Laporan Retur - ".date("d-m-Y");

use Dompdf\Dompdf;

$document = new Dompdf();
$document->loadHtml($html);
$document->setPaper('A4', 'portrait');
$document->render();
$document->stream($title,array("Attachment"=>0));
?>

