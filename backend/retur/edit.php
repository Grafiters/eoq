<?php
include('../../Connect.php');

$id = $_GET['id'];

if (isset($_POST)) {
  $itemId = $_POST['barang'];
  $amount = $_POST['amount'];
  $price = $_POST['price'];
  $stat = $_POST['status'];

  $query = "
  SELECT
    id, total
  FROM pivot_retur
  WHERE retur_id=$id
  AND barang_id=$itemId
  AND status='$stat'";
  $pembelians = $conn->query($query)->fetch_assoc();
  $pembelian = $conn->query("SELECT total FROM retur WHERE id=$id")->fetch_assoc();
  $barang = $conn->query("SELECT total, harga FROM barang WHERE id=$itemId")->fetch_assoc();

  $total = $pembelian['total'] + ($amount * $price);
  $query = "UPDATE retur SET total=$total WHERE id=$id";
  $result = $conn->query($query);

  if ($result) {
    if ($pembelians==NULL) {
      $query = "INSERT INTO pivot_retur(barang_id, retur_id, total, status)VALUES('$itemId', '$id', '$amount', '$stat')";
      $result = $conn->query($query);

      if ($result) {
        $jumlah = $stat == "dilakukan retur" ? $barang['total'] - $amount : $barang['total'] + $amount;
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
      $query = "UPDATE pivot_retur SET total=$jumlah WHERE id=".$pembelians['id'];
      $result = $conn->query($query);

      if ($result) {
        $jumlah = $stat == "dilakukan retur" ? $barang['total'] - $amount : $barang['total'] + $amount;
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

  if ($_POST['tambah']) {
    header("location: /eoq/pages/retur/temp.php?msg=$message&status=$status&id=$id");
  } else {
    header("location: /eoq/pages/retur/edit.php?msg=$message&status=$status&id=$id");
  }
}

?>
