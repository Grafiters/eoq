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
  $harga = mysqli_query($conn, "SELECT harga FROM barang WHERE id='$barang'");
  $getharga = mysqli_fetch_assoc($harga);
  // var_dump($getharga);
  $total = $getharga['harga'] * $amount;

  $result_pjl = $conn->query("INSERT INTO penjualan(pembeli,code, total)VALUES('$name','$code','$total')");

  if($result_pjl){
    $temp = $conn->query("SELECT id FROM penjualan WHERE code='$code'")->fetch_assoc();
    $idTambah = $temp['id'];
    $result_pivot = mysqli_query($conn, "INSERT INTO pivot(penjualan_id,barang_id,total)VALUES('$idTambah','$barang','$amount')");
    if($result_pivot){
      $barang = $conn->query("SELECT id, harga, total FROM barang WHERE id='$barang'")->fetch_assoc();
      $jumlah = $barang['total'] - $amount;
      $barangId = $barang['id'];
      $query = mysqli_query($conn, "UPDATE barang SET total='$jumlah' WHERE id=$barangId");
      $message = 'created successfuly';
      $status = true;
    }else{
      $message = 'failed to created';
      $status = false;
    }
  
  }else{
    $message = 'failed to created';
    $status = false;
  }

  header("location: /eoq/pages/penjualan/index.php?msg=$message&status=$status");
  die();
}

?>
