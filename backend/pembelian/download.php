<?php
include ('../../Connect.php');
require '../../vendor/autoload.php';

if ($conn) {
  $query = "
  SELECT
        pembelian.id AS id,
        pembelian.code AS kode,
        supplier.name AS supplier,
        pembelian.total AS total,
        pembelian.created_at AS tanggal
      FROM pembelian
      INNER JOIN supplier
      ON pembelian.supplier_id=supplier.id";
  $buys = $conn->query($query);
}
// var_dump($buys);
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
