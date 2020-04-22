<?php
    include('../../Connect.php');
    if(isset($_POST)){
        $idpenjualan = $_GET['id'];
        $idpivot = $_GET['pivot'];

        $penjualan = $conn->query("SELECT total FROM penjualan WHERE id=$idpenjualan")->fetch_assoc();
        var_dump($penjualan);
        $pivot = $conn->query("SELECT total, barang_id FROM pivot_pembelian WHERE id=$idpivot")->fetch_assoc();
        $idbarang = $pivot['barang_id'];
        $barang = $conn->query("SELECT harga, total FROM barang pivot WHERE id=$idpivot")->fetch_assoc();

        $totalHarga = $penjualan['total'] - ($barang['harga'] * $pivot['total']);
        $resultPenjualan = $conn->query("UPDATE penjualan SET total = $totalHarga WHERE id=$idpenjualan");

        if($resultPenjualan){
            $query = "DELETE FROM pivot WHERE id=$idpivot";
            $resultPivot=$conn->query($query);

            if($resultPivot){
                $totalBarang = $barang['total'] + $pivot['total'];
                $query = "UPDATE barang SET total=$totalBarang";
                $resultBarang = $conn->query($quqery);

                if($resultBarang){
                    $status = true;
                    $message = "Delete Item Successfully";
                }else{
                    $status = false;
                    $message = "Delete Item Failed";
                }
            }else{
                $status = false;
                $message = "Delete Pivot Failed";
            }

        }else{
            $status = false;
            $message = "Failed to Update Pivot";
        }
    
    header("location: /eoq/pages/penjualan?msg=$message&status=$status");

    }
?>