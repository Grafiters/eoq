<?php
    include_once("../Connect.php");

    if (isset($_POST['update'])) {
        $id = $_POST['user_id'];

        $username=$_POST['username'];
        $name=$_POST['name'];
        $email=$_POST['email'];
        $password=$_POST['password'];
        $status=$_POST['status'];

        $result = mysqli_query($conn, "UPDATE user SET username='$username',name='$name',email='$email',password='$password',status='$status' WHERE user_id=$id");

        if($result){
            header("Location: index.php");
        }
        else{
            echo "Error: " . $result . "<br>" . $conn->error;
        }
    }
?>