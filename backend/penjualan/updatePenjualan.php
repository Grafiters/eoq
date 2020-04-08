<?php
    include("../../Connect.php");

    if (isset($_POST['update'])) {
        $id = $_POST['id'];

        $barang=$_POST['name'];
        $price=$_POST['price'];
        $amount=$_POST['amount'];

        $result = mysqli_query($conn, "UPDATE pivot SET jumlah=$amount WHERE id=$id");

        if($result){
            header("Location: /eoq/pages/penjualan/index.php");
            echo "update succesfully";
        }
        else{
            echo "update Error";
            echo "Error: " . $result . "<br>" . $conn->error;
        }
    }
?> 