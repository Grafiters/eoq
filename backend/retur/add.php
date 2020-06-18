<?php
include("../../Connect.php");

if (isset($_POST)) {
  // variable dari form
  $barangId = $_POST['barang'];
  $supplier = $_POST['supplier'];
  $tanggal = $_POST['tanggal'];
  $amount = $_POST['amount'];
  $stat = $_POST['status'];

  // data dari DB
  $barang = $conn->query("SELECT harga, total FROM barang WHERE id='$barangId'")->fetch_assoc();
  $res = $conn->query("SELECT MAX(id) as maxid FROM retur")->fetch_assoc();

  // Proses
  $code = "RT".sprintf("%03d", $res['maxid']+1);
  $totalHarga = $amount * $barang['harga'];
  
  $query = "INSERT INTO retur(kode, total, supplier_id, tanggal)VALUES('$code', '$totalHarga', '$supplier', '$tanggal')";
  $retur = $conn->query($query);

  if ($retur) {

    $temp = $conn->query("SELECT id FROM retur WHERE kode='$code'")->fetch_all(MYSQLI_ASSOC);
    $returId = $temp[0]['id'];
    $query = "INSERT INTO pivot_retur(barang_id, retur_id, total, status)VALUES('$barangId', '$returId', '$amount', '$stat')";
    $pivotRetur = $conn->query($query);

    if ($pivotRetur) {

      $jumlah = $stat == "dilakukan retur" ? $barang['total'] - $amount : $barang['total'] + $amount;
      $query = "UPDATE barang SET total='$jumlah' WHERE id=$barangId";

      $hasil = $conn->query($query);

      if ($hasil) {
        $status = $hasil;
        $message = "Berhasil membuat retur";
      } else {
        $status = $hasil;
        $message = "Barang gagal diupdate";
      }

    } else {
      $status = $pivotRetur;
      $message = "Gagal membuat pivot retur";
    }

  } else {
    $status = $retur;
    $message = "Retur gagal dibuat";
  }

  $getid = $conn->query("SELECT MAX(id) as id FROM retur")->fetch_all(MYSQLI_ASSOC);
  
  $newid = $getid[0]['id'];

  header("location: /eoq/pages/retur/temp.php?msg=$message&status=$statusg&id=$newid");
}
?>
