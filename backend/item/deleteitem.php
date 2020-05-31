<?php
    include_once("../../Connect.php");

    $id = $_GET['id'];
    
    $query = "DELETE FROM barang WHERE id=$id";
    $result = $conn->query($query); 

    header("Location:/eoq/pages/item/index.php");
?>
