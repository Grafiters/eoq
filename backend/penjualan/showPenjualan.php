<?php
    include('../../Connect.php');
    // $query = "SELECT * FROM user ORDER BY user_id DESC";

    if ($conn) {
      $buys = mysqli_query($conn, "SELECT barang.id AS bid, pivot.id AS id, penjualan.total AS bayar, penjualan.code AS kode, penjualan.created_at AS tanggal FROM barang, penjualan, pivot WHERE pivot.barang_id=barang.id ");
      // var_dump($buys);
    }
?>