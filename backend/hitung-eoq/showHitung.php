<?php
    include ("../../Connect.php");

    $result = $conn->query('SELECT barang.name AS name, hasil.* FROM hasil, barang');
    // var_dump($result);
?>