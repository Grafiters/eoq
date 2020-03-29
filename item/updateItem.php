<?php
    include_once("../Connect.php");

    if (isset($_POST['update'])) {
        $id = $_POST['item_id'];

        $supplier=$_POST['supplier'];
        $type = $_POST['type'];
        $name=$_POST['name'];
        $price=$_POST['price'];
        $stock=$_POST['stock'];

        $result = mysqli_query($conn, "INSERT INTO item SET supplier_id='$supplier',type='$type',name='$name',price='$price',stock='$stock' WHERE item_id = $id");

        if($result){
            echo "updated succesfully";
            header("Location: index.php");
        }
        else{
            echo "Error: " . $result . "<br>" . $conn->error;
        }
    }
?>