<?php
    include("../../Connect.php");

    if(isset($_POST['submit'])){
        $barang = $_POST['barang'];
        $kebutuhan = $_POST['kebutuhan_tahunan'];
        $sekalipesan = $_POST['biaya_sekali_pesan'];
        $simpanbarang = $_POST['biaya_simpan_barang'];
        $tkerja = $_POST['total_kerja'];
        $tunggu = $_POST['waktu_tunggu'];

        $res = $conn->query("SELECT * FROM barang WHERE id=$barang")->fetch_assoc();
        $barangId = $res['id'];

        $hasilpesan = ($kebutuhan/$eoq)*$sekalipesan;
        $hasilsimpan = ($eoq/2)*$simpanbarang;
        $rop = floor(($kebutuhan/$tkerja)*3);
        
        $result = mysqli_query($conn, "INSERT INTO hasil(barang_id,kebutuhan_tahunan,biaya_sekali_pesan,biaya_simpan_barang,eoq,hasil_biasa_pesan,hasil_biaya_simpan,rop)
        VALUES('$barangId','$kebutuhan','$sekalipesan','$simpanbarang','$eoq','$hasilpesan','$hasilsimpan','$rop')");
        
        if($result){
            $messages = "Perhitungan successfully";
        }else{
            $messages = "Perhitungan failed";
        }

        header('Location:/eoq/pages/perhitungan-eoq/index.php?msg=$message');
    }
?>
