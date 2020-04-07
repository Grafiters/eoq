<?php
    include("../../Connect.php");

    if (isset($_POST['submit'])) {
        $code = $_POST['code'];
        $name=$_POST['name'];
        $total = $_POST['total'];
        $keterangan=$_POST['keterangan'];

        $result = mysqli_query($conn, "INSERT INTO barang(code,name,total,keterangan)VALUES('$code','$name','$total','$keterangan')");

        if($result){
            echo "create admin success";
        }else{
            echo "Error: " . $result . "<br>" . $conn->error;
        }
    }
?>