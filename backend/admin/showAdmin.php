<?php
    include('../../Connect.php');
    // $query = "SELECT * FROM user ORDER BY user_id DESC";

    if ($conn) {
      $users = mysqli_query($conn, "SELECT * FROM user ORDER BY id DESC");
      // var_dump($users);
    }
?>