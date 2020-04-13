<?php
include("../../Connect.php");

if (isset($_POST['submit'])) {
  $name = $_POST['namepemb'];
  $barang = $_POST['barang'];
  $amount = $_POST['amount'];

  $query = $conn->query('SELECT MAX(id) as maxId FROM penjualan');
  $hasil = $query->fetch_assoc();
  $idCode = $hasil['maxId'];
  
  $char = "PJL";
  $noUrut = (int)substr($idCode, 0, 2);
  $noUrut++;
  if ($noUrut<10) {
      $code = $char."00".$noUrut;
  }else if($noUrut<100){
      $code = $char."0".$noUrut;
  }else{
      $code = $char.$noUrut;
  }

  $result_pjl = mysqli_query($conn, "INSERT INTO penjualan(pembeli,code)VALUES('$name','$code')");
  // var_dump($result_pjl);

  if($result_pjl){
    $temp = $conn->query("SELECT id FROM penjualan WHERE code='$code'")->fetch_all();
    $idTambah = $temp[0][0];

    $result_pivot = mysqli_query($conn, "INSERT INTO pivot(penjualan_id,barang_id,jumlah)VALUES('$idTambah','$barang','$amount')");
    var_dump($result_pivot);
    if($result_pivot){
      $barang = $conn->query("SELECT harga, total FROM barang WHERE id='$barangId'")->fetch_assoc();
      $jumlah = $barang['total'] - $amount;
      $query = "UPDATE barang SET total='$jumlah' WHERE id=$barang";
      
      $message = 'created successfuly';
      $status = true;
    }else{
      $message = 'failed to created';
      $status = false;
    }
    
    $message = 'created successfuly';
    $status = true;
  }else{
    $message = 'failed to created';
    $status = false;
  }

  header("location: /eoq/pages/penjualan/index.php?msg=$message&status=$status");
  die();
}

?>
