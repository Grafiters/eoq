<?php
    include_once("../../Connect.php");

    if (isset($_POST['update'])) {
        $id = $_POST['id'];

        $code=$_POST['code'];
        $name = $_POST['name'];
        $total=$_POST['total'];
        $satuan=$_POST['satuan'];
        $harga= (int) $_POST['harga'];
        $hargaJual= (int) $_POST['harga_jual'];
        $description=$_POST['description'];

        $result = mysqli_query($conn, "UPDATE barang SET code='$code',name='$name',total='$total',harga='$harga',keterangan='$description',satuan='$satuan',harga_jual='$hargaJual' WHERE id = $id");

        if($result) {
          header("Location: /eoq/pages/item");
        } else {
          echo "Error: " . $result . "<br>" . $conn->error;
        }
    }
?>
