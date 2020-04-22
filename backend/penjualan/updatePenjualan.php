<?php
include('../../Connect.php');

$id = $_GET['id'];

if (isset($_POST)) {
    $itemId = $_POST['barang'];
    $price = $_POST['price'];
    $amount = $_POST['amount'];

    $pivot = $conn->query("SELECT id, total FROM pivot WHERE penjualan_id=$id AND barang_id=$itemId")->fetch_assoc();
    // var_dump($pivot);
    // $nobarang = $pivot['barang_id'];
    // $nopenjualan = $pivot['penjualan_id'];
    $ptotal = $pivot['total'];
    $penjualan = $conn->query("SELECT total FROM penjualan WHERE id=$id")->fetch_assoc();
    // var_dump($penjualan);
    $barang = $conn->query("SELECT total, harga FROM barang WHERE id=$itemId")->fetch_assoc();
    // var_dump($barang);
    $satuan = $barang['harga'];
    $jumlah = $barang['total'];
    $totalpenjualan = $jumlah + ($satuan * $amount);
    $penjualanup = $conn->query("UPDATE penjualan SET total=$totalpenjualan WHERE id=$id");
    if($penjualanup){
       if($pivot == NULL){
            $query = "INSERT INTO pivot(barang_id, penjualan_id, total)VALUES('$itemId', '$id', '$amount')";
            $result = $conn->query($query);

            if($result){
                $totalbarang = $jumlah - $amount;
                $barangup = $conn->query("UPDATE barang SET total=$totalbarang WHERE id=$itemId");
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
            $totalbarang = $jumlah + $amount;
            $pivotup = $conn->query("UPDATE pivot SET total=$amount WHERE id=".$pivot['id']);
            // var_dump($pivotup);
            if($pivotup){
                $totalbarang = $jumlah - $amount;
                $barangup = $conn->query("UPDATE barang SET total=$totalbarang WHERE id=$itemId");
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
