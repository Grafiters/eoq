<?php
include('../../Connect.php');

$id = $_GET['id'];

if (isset($_POST)) {
//   $itemId = $_POST['barang'];
//   $price = $_POST['price'];
    $amount = $_POST['amount'];

    $pivot = $conn->query("SELECT * FROM pivot WHERE id=$id")->fetch_assoc();
    $nobarang = $pivot['barang_id'];
    $nopenjualan = $pivot['penjualan_id'];
    $ptotal = $pivot['total'];
    $penjualan = $conn->query("SELECT total FROM penjualan WHERE id=$nopenjualan")->fetch_assoc();
    $barang = $conn->query("SELECT total, harga FROM barang WHERE id=$nobarang")->fetch_assoc();
    $satuan = $barang['harga'];
    $jumlah = $barang['total'];

    $pivotup = $conn->query("UPDATE pivot SET total=$amount WHERE id=$id");
    if($pivotup){
        $totalpenjualan = $satuan * $amount;
        $penjualanup = $conn->query("UPDATE penjualan SET total=$totalpenjualan WHERE id=$nopenjualan");
        if($penjualanup){
            $totalbarang = $jumlah - $amount;
            $barangup = $conn->query("UPDATE barang SET total=$totalbarang WHERE id=$nobarang");
            if($barangup){
                $message = "updated transaction successfully";
                $status = true;
            }else{
                $message = "updated transaction failed";
                $status = false;
            }
        }else{
            $message = "updated transaction failed";
            $status = false;
        }
    }else{
        $message = "updated transaction failed";
        $status = false;
    }

    // if($result){
    //     $message = "updated transaktion sucessfully";
    //     $status = true;
    // }else{
    //     $message = "updated transaktion failed";
    //     $status = false;
    // }
  

  header("location: /eoq/pages/penjualan?msg=$message&status=$status");
}

?>
