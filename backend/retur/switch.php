<?php
include('../../Connect.php');

$returId = $_GET['id'];
$prId = $_GET['pivot'];
$stats = [
  'dilakukan retur',
  'barang dikembalikan'
];

$pivotRetur = $conn->query("SELECT * FROM pivot_retur WHERE id=$prId")->fetch_all(MYSQLI_ASSOC);
$barangId = $pivotRetur[0]['barang_id'];
$barang = $conn->query("SELECT * FROM barang WHERE id=$barangId")->fetch_all(MYSQLI_ASSOC);
$prAmount = $pivotRetur[0]['total'];
$barangAmount = $barang[0]['total'];
$totalAmount = 0;

if ($pivotRetur[0]['status']==$stats[0]) {
  $totalAmount = $barangAmount + $prAmount;
  $stat = $stats[1];
} else {
  $totalAmount = $barangAmount - $prAmount;
  $stat = $stats[0];
}

$message = "pesan kosong";

$firstRes = $conn->query("UPDATE barang SET total=$totalAmount WHERE id=$barangId");
if ($firstRes) {
  $secondRes = $conn->query("UPDATE pivot_retur SET status='$stat' WHERE id=$prId");
  if ($secondRes) {
    $message = "Sukses mengubah status";
  } else {
    $message = "Gagal update pivot";
  }
} else {
  $message = "Gagal update barang";
}

if ($_POST['tambah']) {
  header("location: /eoq/pages/retur/temp.php?id=$returId&message=$message");
} else {
  header("location: /eoq/pages/retur/edit.php?id=$returId&message=$message");
}

?>
