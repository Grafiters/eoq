<?php
    include_once("../../Connect.php");

    if (isset($_POST['update'])) {
        $id = $_GET['id'];

        $username=$_POST['username'];
        $name=$_POST['name'];
        $email=$_POST['email'];
        $password=$_POST['password'];
        $status=$_POST['status'];

        if ($password=='') {
          $result = mysqli_query($conn, "UPDATE user SET username='$username',name='$name',email='$email',status='$status' WHERE user_id=$id");
        } else {
          $result = mysqli_query($conn, "UPDATE user SET username='$username',name='$name',email='$email',password='$password',status='$status' WHERE user_id=$id");
        }


        if($result){
            header("Location: /pages/admin");
            die();
        } else {
            echo "Error: " . $result . "<br>" . $conn->error;
        }
    }
?>