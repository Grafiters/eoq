<?php
    include_once("../../Connect.php");

    $id = $_GET['item_id'];
    $result = mysqli_query($conn, "DELETE FROM item WHERE item_id=$id"); 

    header("Location:/eoq/pages/item/index.php");
?>