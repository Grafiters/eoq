<?php
    include_once("../../Connect.php");

    $id = $_GET['id'];
    $result = mysqli_query($conn, "DELETE FROM supplier WHERE id=$id"); 

    header("Location: /eoq/pages/reseller/index.php");
?>