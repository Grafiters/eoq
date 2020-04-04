<?php
    include("../../Connect.php");
    $query = "SELECT * FROM user ORDER BY user_id DESC";

    if (!$conn->connect_error) {
      $users = $conn->query($query);
    }
?>
