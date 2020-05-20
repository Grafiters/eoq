<?php
include ('../../Connect.php');
require '../../vendor/autoload.php';

if ($conn) {
  $query = "
  SELECT
    pivot.id AS id,
    barang.name AS barang,
    penjualan.code AS kode,
    penjualan.created_at AS tanggal,
    penjualan.total AS total
  FROM penjualan
  INNER JOIN pivot
  ON pivot.penjualan_id=penjualan.id
  INNER JOIN barang
  ON pivot.barang_id=barang.id
  ";
  $result = $conn->query($query);
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
