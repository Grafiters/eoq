<?php
    include_once("../../Connect.php");

    $id = $_GET['supplier_id'];
    $result = mysqli_query($conn, "DELETE FROM supplier WHERE supplier_id=$id"); 

    header("Location:index.php");
?>