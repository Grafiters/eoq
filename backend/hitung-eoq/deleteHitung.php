<?php
    include_once("../../Connect.php");

    $id = $_GET['id'];
    $query = "DELETE FROM hasil WHERE id=$id";
    $result = $conn->query($query); 

    header("Location:/eoq/pages/perhitungan-eoq/index.php");
?>
