<?php
include ('../../Connect.php');
require '../../vendor/autoload.php';
  session_start();

  if (isset($_POST)) {
    $awal = $_POST['tgl_awal'];
    $akhir = $_POST['tgl_akhir'];

    // var_dump($awal);
    // var_dump($akhir);
    $query = "
      SELECT
        retur.id,
        retur.kode,
        retur.total,
        retur.tanggal,
        supplier.name AS supplier
      FROM retur
      INNER JOIN supplier ON retur.supplier_id=supplier.id
      WHERE retur.tanggal BETWEEN '$awal' AND '$akhir'";
    $buys = $conn->query($query);
    ob_start();
  }
?>
<?= include('../../pages/laporan/pdf/retur.php') ?>

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
