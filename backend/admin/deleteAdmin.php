<?php
    include_once("../../Connect.php");

    $id = $_GET['id'];
    $query = "DELETE FROM user WHERE user_id=$id";
    $result = $conn->query($query);

    header("Location: /pages/admin");
?>
