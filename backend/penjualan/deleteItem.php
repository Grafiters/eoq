<?php
    include('../../Connect.php');
    if(isset($_POST)){
        $idpenjualan = $_GET['id'];
        $idpivot = $_GET['pivot'];

        $penjualan = $conn->query("SELECT total FROM penjualan WHERE id=$idpenjualan")->fetch_assoc();
        $pivot = $conn->query("SELECT total, barang_id FROM pivot WHERE id=$idpivot")->fetch_assoc();
        $idBarang = $pivot['barang_id'];
        $barang = $conn->query("SELECT harga, total FROM barang WHERE id=$idBarang")->fetch_assoc();

        $temp = ($barang['harga'] * $pivot['total']);
        $totalHarga = $penjualan['total'] - $temp;
        $resultPenjualan = $conn->query("UPDATE penjualan SET total = $totalHarga WHERE id=$idpenjualan");

        if($resultPenjualan){
            $query = "DELETE FROM pivot WHERE id=$idpivot";
            $resultPivot=$conn->query($query);

            if($resultPivot){
                $totalBarang = $barang['total'] + $pivot['total'];
                $query = "UPDATE barang SET total=$totalBarang WHERE id=$idBarang";
                $resultBarang = $conn->query($query);

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
    
    $query = $conn->query('SELECT MAX(id) as id FROM penjualan')->fetch_assoc();
    $newid = $query['id'];
    header("location: /eoq/pages/penjualan/edit.php?msg=$message&status=$status&id=$idpenjualan&pivot=$idpivot");

    }
?>
