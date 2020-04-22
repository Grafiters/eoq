<?php
    include_once("../../Connect.php");

    if (isset($_POST['update'])) {
        $id = $_GET['id'];

        $username=$_POST['username'];
        $name=$_POST['name'];
        // $email=$_POST['email'];
        $password=$_POST['password'];
        $role=$_POST['role'];

        if ($password=='') {
          $result = mysqli_query($conn, "UPDATE user SET username='$username',name='$name',role='$role' WHERE id=$id");
        } else {
          $result = mysqli_query($conn, "UPDATE user SET username='$username',name='$name',password='$password',role='$role' WHERE id=$id");
        }


        if($result){
            header("Location:/eoq/pages/admin/index.php");
            die(); 
        } else {
            echo "Error: " . $result . "<br>" . $conn->error;
        }
    }
?>