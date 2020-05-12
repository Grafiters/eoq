<?php
include ('../../Connect.php');
require '../../vendor/autoload.php';

  if (isset($_POST)) {
    $awal = $_POST['tgl_awal'];
    $akhir = $_POST['tgl_akhir'];

    // var_dump($awal);
    // var_dump($akhir);
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
        WHERE penjualan.created_at BETWEEN '$awal' AND '$akhir'";
      $result = $conn->query($query);
      // var_dump($buys);
      ob_start();
  }
?>
<?= include('../../pages/laporan/pdf/penjualan.php') ?>

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