<?php
include("../../Connect.php");

if (isset($_POST)) {
  // variable dari form
  $barangId = $_POST['barang'];
  $supplier = $_POST['supplier'];
  $amount = $_POST['amount'];

  // data dari DB
  $barang = $conn->query("SELECT harga, total FROM barang WHERE id='$barangId'")->fetch_assoc();
  $res = $conn->query("SELECT MAX(id) as maxid FROM pembelian")->fetch_assoc();

  // Proses
  $code = "KB".sprintf("%03d", $res['maxid']+1);
  $totalHarga = $amount * $barang['harga'];
  $query = "INSERT INTO pembelian(supplier_id, code, total)VALUES('$supplier', '$code', '$totalHarga')";
  $pembelian = $conn->query($query);

  if ($pembelian) {

    $temp = $conn->query("SELECT id FROM pembelian WHERE code='$code'")->fetch_all();
    $pembelianId = $temp[0][0];
    $query = "INSERT INTO pivot_pembelian(barang_id, pembelian_id, total)VALUES('$barangId', '$pembelianId', '$amount')";
    $pivotPembelian = $conn->query($query);

    if ($pivotPembelian) {

      $jumlah = $barang['total'] - $amount;
      $query = "UPDATE barang SET total='$jumlah' WHERE id=$barangId";

      $hasil = $conn->query($query);

      if ($hasil) {
        $status = $hasil;
        $message = "Berhasil membuat pembelian";
      } else {
        $status = $hasil;
        $message = "Barang gagal diupdate";
      }

    } else {
      $status = $pivotPembelian;
      $message = "Pembelian gagal dibuat";
    }

  } else {
    $status = $pembelian;
    $message = "Pembelian gagal dibuat";
  }

  header("location: /eoq/pages/pembelian?msg=$message&status=$status");
}
?>
