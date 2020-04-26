<?php
include_once("../../Connect.php");

$idpenjualan = $_GET['id'];
// var_dump($idpenjualan);
$query = "SELECT id, barang_id, total FROM pivot WHERE penjualan_id=$idpenjualan";
$penjualans = $conn->query($query);
$totalItem = $penjualans->num_rows;
// var_dump($totalItem);

$items = $penjualans->fetch_all();
// var_dump($items);
for ($i = 0; $i < $totalItem; $i++) {
  $barang = $conn->query("SELECT total FROM barang WHERE id=".$items[$i][1])->fetch_assoc();
  $totalBarang = $barang['total'] + $items[$i][2];
  //   var_dump($totalBarang);
  $query = "UPDATE barang SET total=".$totalBarang." WHERE id=".$items[$i][1];
  $resultBarang = $conn->query($query);

  if (!$resultBarang) {
    $status = false;
    $message = "Gagal mengubah total barang";
    break;
  } else {
    $status = true;
  }

}

if ($status) {
  $resultpivot = mysqli_query($conn, "DELETE FROM pivot WHERE pivot.penjualan_id='$idpenjualan'");
  $resultpenjualan = mysqli_query($conn, "DELETE FROM penjualan WHERE penjualan.id='$idpenjualan'");
  //   var_dump($resultpenjualan);
  if ($resultpenjualan) {
    $status = true;
    $message = "Sukses menghapus penjualan";
    // echo $message;
  } else {
    $status = false;
    $message = "Gagal menghapus penjualan";
    // echo $message;
  }
} else {
  $status = false;
  $message = "Gagal mengubah total barang";
}

header("location: /eoq/pages/penjualan?msg=$message&status=$status");
?>
