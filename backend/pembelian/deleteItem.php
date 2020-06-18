<?php
include('../../Connect.php');

if (isset($_POST)) {
  $idPembelian = $_GET['id'];
  $idPivot = $_GET['pivot'];

  $pembelian = $conn->query("SELECT total FROM pembelian WHERE id=$idPembelian")->fetch_assoc();
  $pivot = $conn->query("SELECT total, barang_id FROM pivot_pembelian WHERE id=$idPivot")->fetch_assoc();
  $idBarang = $pivot['barang_id'];
  $barang = $conn->query("SELECT harga, total FROM barang WHERE id=$idBarang")->fetch_assoc();

  $totalHarga = $pembelian['total'] - ($barang['harga'] * $pivot['total']);
  $resultPembelian = $conn->query("UPDATE pembelian SET total=$totalHarga WHERE id=$idPembelian");

  if ($resultPembelian) {

    $query = "DELETE FROM pivot_pembelian WHERE id=$idPivot";
    $resultPivot = $conn->query($query);

    if ($resultPivot) {

      $totalBarang = $barang['total'] - $pivot['total'];
      $query = "UPDATE barang SET total=$totalBarang WHERE id=$idBarang";
      $resultBarang = $conn->query($query);

      if ($resultBarang) {
        $status = true;
        $message = "Sukses menghapus barang pembelian";
      } else {
        $status = false;
        $message = "Gagal menghapus pivot pembelian";
      }
      
    } else {
      $status = false;
      $message = "Gagal menghapus pivot pembelian";
    }

  } else {
    $status = false;
    $message = "Gagal meng-update pembelian";
  }

  if ($_POST['tambah']) {
    header("location: /eoq/pages/pembelian/temp.php?msg=$message&status=$status&id=$idPembelian&pivoy=$idPivot");
  } else {
    header("location: /eoq/pages/pembelian/edit.php?msg=$message&status=$status&id=$idPembelian&pivoy=$idPivot");
  }

}

?>
