<?php
include('../../Connect.php');
// $query = "SELECT * FROM user ORDER BY user_id DESC";

if ($conn) {
  // $query = "SELECT barang.id AS bid, pivot.id AS id, penjualan.total AS bayar, penjualan.code AS kode, penjualan.created_at AS tanggal FROM barang, penjualan, pivot WHERE pivot.barang_id=barang.id ";
  $query = "
    SELECT
      pivot.penjualan_id AS id,
      pivot.jumlah * barang.harga AS bayar,
      penjualan.code AS kode,
      penjualan.created_at AS tanggal
    FROM pivot
    INNER JOIN penjualan ON pivot.penjualan_id=penjualan.id
    INNER JOIN barang ON pivot.barang_id=barang.id
  ";
  $buys = $conn->query($query);
  // var_dump($buys);
}
?>
