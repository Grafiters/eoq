<?php
    include ('../../Connect.php');
    require_once ('../dompdf/autoload.inc.php');

    // var_dump($query);

    use Dompdf\Dompdf;
    $document = new Dompdf();
    $page = file_get_contents("../../pages/laporan/pdf/penjualan.php");
    
    $document->load_html($page);
    $document->setPaper('A4', 'lanscape');
    $document->render();
    $document->stream('Eoq', array("Attachment"=>0));
?>