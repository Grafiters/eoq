<?php
   session_start();
   include('../../Connect.php');

   $user_check = $_POST['username'];
   $pass_check = $_POST['password'];

   $ses_sql = mysqli_query($conn,"select * from user where username = '$user_check' and password ='$pass_check'");

   $row = mysqli_num_rows($ses_sql);

   if ($row > 0) {
      $result = mysqli_fetch_assoc($ses_sql);
      if($result['status'] == "admin"){
         $_SESSION['username'] = $user_check;
         $_SESSION['status'] = "admin";
         echo "admin";
      //    header("Location: ../index2.php", true);
      //    die();
     }else if($result['status'] == "pengadaan"){
         $_SESSION['username'] = $user_check;
         $_SESSION['status'] = "pengadaan";
         echo "pengadaan";
      //    header("Location: ../index2.php", true);
      //    die();
     }else if($result['status'] == "suplier"){
         $_SESSION['username'] = $user_check;
         $_SESSION['status'] = "suplier";
         echo "suplier";
      //    header("Location: ../index2.php", true);
      //    die();
     }else{
      //    header("Location: ../index2.php", true);
         echo "Username dan Password salah";
     }
   }
   // header("Location: /eoq/pages/admin/index.php");

?>