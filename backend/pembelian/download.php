<?php
  include ('../../Connect.php');
  require '../../vendor/autoload.php';
  session_start();

  if ($conn) {
    $awal = "";
    $query = "
    SELECT
          pembelian.id AS id,
          pembelian.code AS kode,
          pembelian.supplier AS supplier,
          pembelian.total AS total,
          pembelian.tanggal AS tanggal
        FROM pembelian";
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
