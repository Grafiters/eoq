<?php
include("../../Connect.php");

if (isset($_POST['submit'])) {
  $username=$_POST['username'];
  $name=$_POST['name'];
  $telp=$_POST['tlep'];
  $email=$_POST['email'];
  $password=hash('sha512', $_POST['password']);
  $status=$_POST['status'];
  
  $hashpas = hash('sha512',$password);

  $inrole = substr($status,0,2);
  $inname = substr($username,0,2);
  $code = $inrole.$inname;

  $result = mysqli_query($conn, "INSERT INTO user(username,name,email,phone,password,role,code)VALUES('$username','$name','$email','$telp','$hashpas','$status','$code')");

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
