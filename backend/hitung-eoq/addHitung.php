<?php
    include("../../Connect.php");

    if(isset($_POST['submit'])){
        $barang = $_POST['barang'];
        $sekalipesan = $_POST['biaya_sekali_pesan'];
        $simpanbarang = $_POST['biaya_simpan_barang'];
        $tkerja = $_POST['total_kerja'];
        $tunggu = $_POST['waktu_tunggu'];
        $tanggal = $_POST['tanggal'];
        $data = $_POST['data'];

        $res = $conn->query("SELECT * FROM barang WHERE id=$barang")->fetch_assoc();
        $barangId = $res['id'];
        $tempKebutuhanQuery = "
          SELECT
            SUM(pivot_pembelian.total) as total
          FROM pembelian
          INNER JOIN pivot_pembelian
          ON pembelian.id = pivot_pembelian.pembelian_id
          WHERE
            YEAR(pembelian.tanggal)=$data AND
            barang_id=$barang
        ";
        $tempKebutuhan = $conn->query($tempKebutuhanQuery)->fetch_assoc();
        $kebutuhan = $tempKebutuhan['total'];

        $eoq = floor(sqrt((2*($sekalipesan*$kebutuhan))/$simpanbarang));
        $hasilpesan = ($kebutuhan/$eoq)*$sekalipesan;
        $hasilsimpan = ($eoq/2)*$simpanbarang;
        $rop = floor(($kebutuhan/$tkerja)*3);
        
        $query = "
          INSERT INTO hasil (
            barang_id,kebutuhan_tahunan,biaya_sekali_pesan,
            biaya_simpan_barang,eoq,hasil_biasa_pesan,
            hasil_biaya_simpan,rop,tunggu,
            tanggal,tahun,kerja
          ) VALUES (
            '$barangId','$kebutuhan','$sekalipesan',
            '$simpanbarang','$eoq','$hasilpesan',
            '$hasilsimpan','$rop','$tunggu',
            '$tanggal','$data','$tkerja'
          )";
        $result = $conn->query($query);

        if($result){
            $messages = "Perhitungan successfully";
        }else{
            $messages = "Perhitungan failed";
        }

        header("Location:/eoq/pages/perhitungan-eoq/index.php?msg=$message");
    }
?>
