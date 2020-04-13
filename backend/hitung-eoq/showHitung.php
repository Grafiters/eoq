<?php
    include ("../../Connect.php");

    $result = $conn->query('SELECT barang.name AS name, hasil.* FROM hasil, barang WHERE hasil.id=barang.id');
    // var_dump($result);
?>