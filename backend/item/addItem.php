<?php
    include("../../Connect.php");

    if (isset($_POST['submit'])) {
        $name=$_POST['name'];
        $total = (int) $_POST['total'];
        $keterangan = $_POST['keterangan'];
        $price = (int) $_POST['harga'];

        $query = $conn->query('SELECT MAX(id) as maxId FROM barang');
        $hasil = $query->fetch_assoc();
        $idCode = $hasil['maxId'];

        $char = "ITM";
        $noUrut = (int)substr($idCode, 0, 2);
        $noUrut++;
        if ($noUrut<10) {
            $code = $char."00".$noUrut;
        }else if($noUrut<100){
            $code = $char."0".$noUrut;
        }else{
            $code = $char.$noUrut;
        }

        $result = $conn->query("INSERT INTO barang(code,name,total,harga,keterangan)VALUES('$code','$name','$total','$price','$keterangan')");

        if($result){
          header("location: /eoq/pages/item");
        }else{
            echo "Error: " . $result . "<br>" . $conn->error;
        }
    }
?>
