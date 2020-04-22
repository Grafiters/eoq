<?php
    include_once("../../Connect.php");

    $id = $_GET['id'];
    $query = "DELETE FROM user WHERE id=$id";
    $result = $conn->query($query);
    // var_dump($result);

    header("Location:/eoq/pages/admin/index.php");
?>