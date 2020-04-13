<?php
    include_once("../../Connect.php");

    $idpenjualan = $_GET['id'];
    $query = "SELECT id, barang_id, total FROM pivot WHERE penjualan_id=$idpenjualan";
    $penjualans = $conn->query($query);
    // $totalItem = $penjualans->num_rows;

    // $items = $penjualans->fetch_all();

    // for ($i = 0; $i < $totalItem; $i++) {
    //   $barang = $conn->query("SELECT total FROM barang WHERE id=".$items[$i][1])->fetch_assoc();
    //   $totalBarang = $barang['total'] + $items[$i][2];
    //   $query = "UPDATE barang SET total=".$totalBarang." WHERE id=".$items[$i][1];
    //   $resultBarang = $conn->query($query);

    //   if (!$resultBarang) {
    //     $status = false;
    //     $message = "Gagal mengubah total barang";
    //     break;
    //   } else {
    //     $status = true;
    //   }

    // }

    if ($status) {
      $resultpenjualan = $conn->query("DELETE FROM penjualan WHERE id=$idpenjualan");
      if ($resultpenjualan) {
        $status = true;
        $message = "Sukses menghapus penjualan";
      } else {
        $status = false;
        $message = "Gagal menghapus penjualan";
      }
    } else {
      $status = false;
      $message = "Gagal mengubah total barang";
    }

    header("Location: /eoq/pages/penjualan/index.php");
?>