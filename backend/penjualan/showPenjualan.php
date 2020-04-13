<?php
    include('../../Connect.php');
    // $query = "SELECT * FROM user ORDER BY user_id DESC";

    if ($conn) {
      $buys = mysqli_query($conn, "SELECT pivot.id AS id, penjualan.code AS kode, penjualan.created_at AS tanggal, barang.harga*pivot.jumlah AS bayar FROM barang, penjualan, pivot WHERE barang.id=penjualan.id=pivot.id ");
    //   var_dump($buys);
    }
?>