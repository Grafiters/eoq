<?php
include("../Connect.php");

if (isset($_POST['submit'])) {
  $username=$_POST['username'];
  $name=$_POST['name'];
  $email=$_POST['email'];
  $password=hash('sha512', $_POST['password']);
  $status=$_POST['status'];

  $result = mysqli_query($conn, "INSERT INTO user(username,name,email,password,status)VALUES('$username','$name','$email','$password','$status')");

  if($result){
    $message = 'Sukses membuat admin';
    $status = true;
  }else{
    $message = 'Gagal membuat admin';
    $status = false;
  }

  header("location: /pages/admin?msg=$message&status=$status");
  die();
}

?>
