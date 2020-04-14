<?php
    include('../../Connect.php');
    // $query = "SELECT * FROM user ORDER BY user_id DESC";

    if ($conn) {
      $buys = mysqli_query($conn, "SELECT pivot.id AS pid, penjualan.id AS id, penjualan.total AS bayar, penjualan.code AS kode, penjualan.created_at AS tanggal FROM penjualan INNER JOIN pivot ON pivot.penjualan_id=penjualan.id");
      // var_dump($buys);
    }
?>