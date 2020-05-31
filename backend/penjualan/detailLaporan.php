<?php
include ('../../Connect.php');
require '../../vendor/autoload.php';
session_start();

if ($conn) {
  $penjualanId = $_GET['id'];
  $query = "
    SELECT
      penjualan.id AS id,
      penjualan.code AS kode,
      penjualan.pembeli AS pembeli,
      penjualan.tanggal AS tanggal,
      barang.name AS barang,
      barang.harga_jual AS harga,
      pivot.total AS total
    FROM penjualan
    INNER JOIN pivot ON penjualan.id = pivot.penjualan_id
    INNER JOIN barang on pivot.barang_id = barang.id
    WHERE penjualan.id = $penjualanId
  ";
  $buys = $conn->query($query);
}
$temp = $buys->fetch_all(MYSQLI_BOTH);
ob_start();
?>

<?= include('../../pages/laporan/pdf/penjualan_detail.php') ?>

<?php
$html = ob_get_clean();
$title = "Laporan Penjualan - ".date("d-m-Y");

use Dompdf\Dompdf;

$document = new Dompdf();
$document->loadHtml($html);
$document->setPaper('A4', 'portrait');
$document->render();
$document->stream($title,array("Attachment"=>0));
?>
