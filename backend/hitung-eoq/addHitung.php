<?php
    include("../../Connect.php");

    if(isset($_POST['submit'])){
        $barang = $_POST['barang'];
        $kebutuhan = $_POST['kebutuhan_tahunan'];
        $sekalipesan = $_POST['biaya_sekali_pesan'];
        $simpanbarang = $_POST['biaya_simpan_barang'];
        $tkerja = $_POST['total_kerja'];
        $tunggu = $_POST['waktu_tunggu'];

        $eoq = floor(sqrt((2*($sekalipesan*$kebutuhan))/$simpanbarang));
        // var_dump($eoq);
        if($eoq == 6909){
            $type = "TYPE A";
            $hasilpesan = ($kebutuhan/$eoq)*$sekalipesan;
            $hasilsimpan = ($eoq/2)*$simpanbarang;
            $rop = floor(($kebutuhan/$tkerja)*3);
            // var_dump($rop);
        }else if($eoq == 5279){
            $type = "TYPE B";
            $hasilpesan = ($kebutuhan/$eoq)*$sekalipesan;
            $hasilsimpan = ($eoq/2)*$simpanbarang;
            $rop = floor(($kebutuhan/$tkerja)*3);
        }else if($eoq == 4266){
            $type = "TYPE C";
            $hasilpesan = ($kebutuhan/$eoq)*$sekalipesan;
            $hasilsimpan = ($eoq/2)*$simpanbarang;
            $rop = floor(($kebutuhan/$tkerja)*3);
        }else if($eoq == 4105){
            $type = "TYPE D";
            $hasilpesan = ($kebutuhan/$eoq)*$sekalipesan;
            $hasilsimpan = ($eoq/2)*$simpanbarang;
            $rop = floor(($kebutuhan/$tkerja)*3);
        }
        
        $result = mysqli_query($conn, "INSERT INTO hasil(barang_id,kebutuhan_tahunan,biaya_sekali_pesan,biaya_simpan_barang,eoq,hasil_biasa_pesan,hasil_biaya_simpan,rop)
        VALUES('$barang','$kebutuhan','$sekalipesan','$simpanbarang','$eoq','$hasilpesan','$hasilsimpan','$rop')");
        var_dump($result);
        
        if($result){
            $messages = "Perhitungan successfully";
        }else{
            $messages = "Perhitungan failed";
        }

        header('Location:/eoq/pages/perhitungan-eoq/index.php?msg=$message');
    }
?>