<?php
include('../../Connect.php');

$id = $_GET['id'];

if (isset($_POST)) {
  $itemId = $_POST['barang'];
  $amount = $_POST['amount'];
  $price = $_POST['price'];

  $query = "SELECT
    id, total
  FROM pivot_pembelian
  WHERE pembelian_id=$id AND barang_id=$itemId";
  $pembelians = $conn->query($query)->fetch_assoc();
  $pembelian = $conn->query("SELECT total FROM pembelian WHERE id=$id")->fetch_assoc();
  $barang = $conn->query("SELECT total, harga FROM barang WHERE id=$itemId")->fetch_assoc();

  $total = $pembelian['total'] + ($amount * $price);
  $query = "UPDATE pembelian SET total=$total WHERE id=$id";
  $result = $conn->query($query);

  if ($result) {
    if ($pembelians==NULL) {
      $query = "INSERT INTO pivot_pembelian(barang_id, pembelian_id, total)VALUES('$itemId', '$id', '$amount')";
      $result = $conn->query($query);

      if ($result) {
        $jumlah = $barang['total'] - $amount;
        $query = "UPDATE barang SET total='$jumlah' WHERE id=$itemId";
        $result = $conn->query($query);
        if ($result) {
          $status = $result;
          $message = "Transaksi berhasil disimpan";
        } else {
          $status = false;
          $message = "Transaksi gagal dibuat";
        }
      } else {
        $status = false;
        $message = "Gagal Menyimpan transaksi baru";
      }

    } else {
      $jumlah = $pembelians['total'] + $amount;
      $query = "UPDATE pivot_pembelian SET total=$jumlah WHERE id=".$pembelians['id'];
      $result = $conn->query($query);

      if ($result) {
        $jumlah = $barang['total'] - $amount;
        $query = "UPDATE barang SET total='$jumlah' WHERE id=$itemId";
        $result = $conn->query($query);

        if ($result) {
          $status = $result;
          $message = "Berhasil update pembelian";
        } else {
          $status = false;
          $message = "Transaksi gagal diupdate";
        }
      } else {
        $status = false;
        $message = "Gagal Menyimpan transaksi baru";
      }

    }
  } else {
    $status = $result;
    $message = "Gagal Menyimpan transaksi baru";
  }

  header("location: /eoq/pages/pembelian?msg=$message&status=$status");
}

?>
