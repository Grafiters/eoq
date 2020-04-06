<?php
    include("../../Connect.php");

    if (isset($_POST['submit'])) {
        $supplier=$_POST['supplier'];
        $type = $_POST['type'];
        $name=$_POST['name'];
        $price=$_POST['price'];
        $stock=$_POST['stock'];

    $result = mysqli_query($conn, "INSERT INTO item(supplier_id,type,name,price,stock)VALUES('$supplier','$type','$name','$price','$stock')");

    if($result){
        echo "create admin success";
    }else{
        echo "Error: " . $result . "<br>" . $conn->error;
    }
}

?>