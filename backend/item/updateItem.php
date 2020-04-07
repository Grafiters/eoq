<?php
    include_once("../../Connect.php");

    if (isset($_POST['update'])) {
        $id = $_POST['id'];

        $code=$_POST['code'];
        $name = $_POST['name'];
        $total=$_POST['total'];
        $description=$_POST['keterangan'];

        $result = mysqli_query($conn, "UPDATE barang SET code='$code',name='$name',total='$total',description='$description' WHERE id = $id");

        if($result){
            echo "updated succesfully";
            header("Location: /eoq/pages/item/index.php");
        }
        else{
            echo "Error: " . $result . "<br>" . $conn->error;
        }
    }
?>