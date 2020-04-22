<?php
include('../../Connect.php');

$query = "
  SELECT
    pembelian.id AS id,
    pembelian.code AS kode,
    supplier.name AS supplier,
    pembelian.total AS total,
    pembelian.created_at AS tanggal
  FROM pembelian
  INNER JOIN supplier
  ON pembelian.supplier_id=supplier.id
";

$pembelians = $conn->query($query)->fetch_all();

$conn->close();
?>

