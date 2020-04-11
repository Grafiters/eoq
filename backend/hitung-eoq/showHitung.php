<?php
    include ("../../Connect.php");

    $result = $conn->query('SELECT barang.id, hasil.* FROM hasil, barang WHERE barang.id=hasil.id');
    // var_dump($result);
?>