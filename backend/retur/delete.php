<?php

include('../../Connect.php');

if (isset($_POST)) {
  $idPembelian = $_GET['id'];
  $query = "SELECT id, barang_id, total, status FROM pivot_retur WHERE retur_id=$idPembelian";
  $pembelians = $conn->query($query);
  $totalItem = $pembelians->num_rows;

  $items = $pembelians->fetch_all(MYSQLI_ASSOC);

  for ($i = 0; $i < $totalItem; $i++) {
    $barang = $conn->query("SELECT total FROM barang WHERE id=".$items[$i]['barang_id'])->fetch_assoc();
    
    $amount = $items[$i]['total'];
    $totalBarang = $items[$i]['status'] != "dilakukan retur" ? $barang['total'] : $barang['total'] + $amount;
    $query = "UPDATE barang SET total=".$totalBarang." WHERE id=".$items[$i]['barang_id'];
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
    $query = "DELETE FROM retur WHERE id=$idPembelian";
    $resultPembelian = $conn->query($query);
    
    if ($resultPembelian) {
      $status = true;
      $message = "Sukses menghapus retur";
    } else {
      $status = false;
      $message = "Gagal menghapus retur";
    }
  } else {
    $status = false;
    $message = "Gagal mengubah total barang";
  }

  header("location: /eoq/pages/retur?msg=$message&status=$status");

}

?>
