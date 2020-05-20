<?php
include ('../../Connect.php');
require '../../vendor/autoload.php';
session_start();

if ($conn) {
  $id = $_GET['id'];
  $query = "
  SELECT *
  FROM hasil
  INNER JOIN barang ON hasil.barang_id = barang.id
  WHERE hasil.id=$id
  ";
  $result = $conn->query($query);
}
$temp = $result->fetch_all(MYSQLI_BOTH)[0];
ob_start();
?>

<?= include('../../pages/laporan/pdf/eoq.php') ?>

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

