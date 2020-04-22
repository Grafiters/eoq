<?php
   session_start();
   include('../../Connect.php');

   $user_check = $_POST['username'];
   $pass_check = $_POST['password'];
   $hashpass = hash('sha512',$pass_check);

   $ses_sql = mysqli_query($conn,"SELECT * FROM user WHERE username = '$user_check' and password ='$hashpass'");
   // var_dump($ses_sql);

   $row = mysqli_num_rows($ses_sql);

   if ($row > 0) {
      $result = mysqli_fetch_assoc($ses_sql);
      if($result['role'] == "admin"){
         $_SESSION['username'] = $user_check;
         $_SESSION['role'] = "admin";
         $role = "admin";
         header("Location: /eoq/pages/admin/index.php");
         //    header("Location: ../index2.php", true);
         //    die();
      }else if($result['role'] == "pengadaan"){
         $_SESSION['username'] = $user_check;
         $_SESSION['role'] = "pengadaan";
         $role = "pengadaan";
         header("Location:/eoq/pages/admin/index.php");
         //    header("Location: ../index2.php", true);
         //    die();
      }else if($result['role'] == "penjualan"){
         $_SESSION['username'] = $user_check;
         $_SESSION['role'] = "penjualan";
         $role = "penjualan";
         header("Location:/eoq/pages/penjualan/index.php");
         //    header("Location: ../index2.php", true);
         //    die();
      }else{
         //    header("Location: ../index2.php", true);
         echo "Username dan Password salah";
      }
   }
   // header("Location: /eoq/pages/admin/index.php");

?>