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
      ON pembelian.supplier_id=supplier.id
  ";
  $result = $conn->query($query);
  
}
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
