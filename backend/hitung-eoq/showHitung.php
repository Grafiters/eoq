<?php
  include ("../../Connect.php");

  $query = "SELECT *, barang.name AS barang FROM hasil INNER JOIN barang ON hasil.barang_id=barang.id";
  $result = $conn->query($query);

?>
