<?php
  include('../../Connect.php');
  // $query = "SELECT * FROM user ORDER BY user_id DESC";

    if ($conn) {
    $buys = mysqli_query($conn, "SELECT penjualan.id AS id, penjualan.total AS bayar, penjualan.code AS kode, penjualan.created_at AS tanggal FROM penjualan");
      // var_dump($buys);
    }
?>

