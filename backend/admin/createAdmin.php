<?php
include("../../Connect.php");

if (isset($_POST['submit'])) {
  $username=$_POST['username'];
  $name=$_POST['name'];
  $phone=$_POST['phone'];
  $email=$_POST['email'];
  $password=hash('sha512', $_POST['password']);
  $role=$_POST['status'];
  
  // $hashpas = hash('sha512',$password);

  $inrole = substr($role,0,2);
  $inname = substr($username,0,2);
  $code = $inrole.$inname;

  $query = "INSERT INTO user(username,name,email,phone,password,role,code)VALUES('$username','$name','$email','$phone','$password','$role','$code')";
  // var_dump($query);
  // die();
  
  $result = $conn->query($query);
  // var_dump($result);

  if($result){
    $message = 'Sukses membuat admin';
    // $role = true;
    header("location: /eoq/pages/admin?msg=$message&status=$status");
  }else{
    $message = 'Gagal membuat admin';
    // $role = false;
  }

}

?>
