<?php
  include('../../Connect.php');
  // $query = "SELECT * FROM user ORDER BY user_id DESC";

  if ($conn) {
    $query = "SELECT penjualan.id AS id, penjualan.total AS bayar, penjualan.code AS kode, penjualan.tanggal AS tanggal FROM penjualan";
    $buys = $conn->query($query);
  }
  
?>

