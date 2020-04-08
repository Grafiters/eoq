<?php
    include_once("../../Connect.php");

    $id = $_GET['id'];
    $query = "DELETE FROM pivot WHERE id=$id";
    $result = $conn->query($query);

    header("Location: /eoq/pages/penjualan/index.php");
?>