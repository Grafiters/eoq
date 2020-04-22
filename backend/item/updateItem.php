<?php
    include_once("../../Connect.php");

    if (isset($_POST['update'])) {
        $id = $_POST['id'];

        $code=$_POST['code'];
        $name = $_POST['name'];
        $total=$_POST['total'];
        $harga=$_POST['harga'];
        $description=$_POST['description'];

        $result = mysqli_query($conn, "UPDATE barang SET code='$code',name='$name',total='$total',harga='$harga',description='$description' WHERE id = $id");

        if($result) {
          header("Location: /eoq/pages/item/index.php");
        } else {
          echo "Error: " . $result . "<br>" . $conn->error;
        }
    }
?>
