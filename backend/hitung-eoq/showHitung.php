<?php
  include ("../../Connect.php");

  $query = "SELECT *, barang.name AS barang FROM hasil INNER JOIN barang ON hasil.barang_id=barang.id";
  $result = $conn->query($query);

  $tempYearsQuery = "SELECT DISTINCT YEAR(pembelian.tanggal) AS tahun FROM pembelian";
  $tempYears = $conn->query($tempYearsQuery);
  $years = $tempYears->fetch_all(MYSQLI_BOTH);

?>
