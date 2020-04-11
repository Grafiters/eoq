<?php
    include("../../Connect.php");

    if(isset($_POST['submit'])){
        $barang = $_POST['barang'];
        $kebutuhan = $_POST['kebutuhan_tahunan'];
        $sekalipesan = $_POST['biaya_sekali_pesan'];
        $simpanbarang = $_POST['biaya_simpan_barang'];
        $tkerja = $_POST['total_kerja'];
        $tunggu = $_POST['waktu_tunggu'];

        $eoq;
        $hasilpesan;
        $hasilsimpan;
        $rop;

        $result = $conn->query('INSERT INTO hasil(barang_id, kebutuhan_tahunan, biaya_Sekali_pesan, biaya_sekali_simpan, eoq, hasil_biasa_pesan, hasil_biaya_simpan, rop)
                                VALUES()');
    }
?>