<?php

include('../../Connect.php');

if (isset($_POST)) {
  $idPembelian = $_GET['id'];
  $query = "SELECT id, barang_id, total FROM pivot_pembelian WHERE pembelian_id=$idPembelian";
  $pembelians = $conn->query($query);
  $totalItem = $pembelians->num_rows;

  $items = $pembelians->fetch_all();

  for ($i = 0; $i < $totalItem; $i++) {
    $barang = $conn->query("SELECT total FROM barang WHERE id=".$items[$i][1])->fetch_assoc();
    $totalBarang = $barang['total'] + $items[$i][2];
    $query = "UPDATE barang SET total=".$totalBarang." WHERE id=".$items[$i][1];
    $resultBarang = $conn->query($query);

    if (!$resultBarang) {
      $status = false;
      $message = "Gagal mengubah total barang";
      break;
    } else {
      $status = true;
    }

  }

  if ($status) {
    $resultPembelian = $conn->query("DELETE FROM pembelian WHERE id=$idPembelian");
    if ($resultPembelian) {
      $status = true;
      $message = "Sukses menghapus pembelian";
    } else {
      $status = false;
      $message = "Gagal menghapus pembelian";
    }
  } else {
    $status = false;
    $message = "Gagal mengubah total barang";
  }

  header("location: /eoq/pages/pembelian?msg=$message&status=$status");

}

?>
