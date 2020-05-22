<?php
include ('../../Connect.php');
require '../../vendor/autoload.php';
session_start();

  if (isset($_POST)) {
    $awal = $_POST['tgl_awal'];
    $akhir = $_POST['tgl_akhir'];

    // var_dump($awal);
    // var_dump($akhir);
    $query = "SELECT * FROM penjualan WHERE penjualan.tanggal BETWEEN '$awal' AND '$akhir'";
    $result = $conn->query($query);
    $buys = $result->fetch_all(MYSQLI_BOTH);
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
