<?php
include("../Connect.php");

if (isset($_POST['submit'])) {
  $username=$_POST['username'];
  $name=$_POST['name'];
  $email=$_POST['email'];
  $password=$_POST['password'];
  $status=$_POST['status'];

  $result = mysqli_query($conn, "INSERT INTO user(username,name,email,password,status)VALUES('$username','$name','$email','$password','$status')");

  if($result){
    header('location: /pages/admin');
    die();
  }else{
    echo "Error: " . $result . "<br>" . $conn->error;
  }
}

?>
