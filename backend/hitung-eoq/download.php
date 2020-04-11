<?php
    include ('../../Connect.php');
    require_once ('../dompdf/autoload.inc.php');
    $id = $_GET['id'];
    $query = mysqli_query($conn, "SELECT barang.name AS name, hasil.* FROM barang, hasil WHERE hasil.id=$id");
    // var_dump($query);
    while($result = mysqli_fetch_array($query)){
        $barang = $result['name'];
        $kebutuhan = $result['kebutuhan_tahunan'];
        $sekalipesan = $result['biaya_sekali_pesan'];
        $biayasimpan = $result['biaya_simpan_barang'];
        $eoq = $result['eoq'];
        $hasilpesan = $result['hasil_biasa_pesan'];
        $hasilsimpan = $result['hasil_biaya_simpan'];
        $rop = $result['rop'];
        $tanggal = $result['created_at'];
    }

    use Dompdf\Dompdf;
    $document = new Dompdf();

    $html = '<html><body'.
            '<center></center><br>'.
            '<center>Hasil Perhitungan</center><br>'.
            '<center>Hasil dari perhitungan EOQ pada GTT Groub</center><br>'.
            'Nama : '.$barang.'<br>'.
            'Nama : '.$kebutuhan.'<br>'.
            'Nama : '.$sekalipesan.'<br>'.
            'Nama : '.$biayasimpan.'<br>'.
            'Nama : '.$eoq.'<br>'.
            'Nama : '.$hasilpesan.'<br>'.
            'Nama : '.$hasilsimpan.'<br>'.
            'Nama : '.$rop.'<br>'.
            'Nama : '.$tanggal.'<br>'.
            '</body></html>';
    
    $document->load_html($html);
    $document->setPaper('A4', 'lanscape');
    $document->render();
    $document->stream('Eoq', array("Attachment"=>0));
?>