<?php
include("../../Connect.php");

if (isset($_POST['submit'])) {
  $tanggal = $_POST['tanggal'];
  $name = $_POST['namepemb'];
  $barang = $_POST['barang'];
  $price = $_POST['price'];
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

  $result_pjl = mysqli_query($conn, "INSERT INTO penjualan(pembeli,code,created_at)VALUES('$name','$code','$tanggal')");

  $querypjl = $conn->query('SELECT MAX(id) AS idNew FROM penjualan');
  $hasilpjl = $querypjl->fetch_assoc();
  $idTambah = $hasilpjl['idNew'];
  $idTambah++;
  
  $result_pivot = mysqli_query($conn, "INSERT INTO pivot(penjualan_id,barang_id)VALUES('$idTambah','$barang','$amount')");

  if($result_pjl && $result_pivot){
    $message = 'created successfuly';
    $status = true;
  }else{
    $message = 'failed to created';
    $status = false;
  }

  header("location: eoq/pages/penjualan/index.php?msg=$message&status=$status");
  die();
}

?>
