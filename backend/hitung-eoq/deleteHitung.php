<?php
    include_once("../../Connect.php");

    $id = $_GET['id'];
    $result = mysqli_query($conn, "DELETE FROM hasil WHERE id=$id"); 

    header("Location:/eoq/pages/perhitungan-eoq/index.php");
?>