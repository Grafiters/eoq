<?php
    include("../../Connect.php");

    if (isset($_POST['submit'])) {
        $name=$_POST['name'];
        $total = $_POST['total'];
        $keterangan=$_POST['keterangan'];

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

        $result = mysqli_query($conn, "INSERT INTO barang(code,name,total,keterangan)VALUES('$code','$name','$total','$keterangan')");

        if($result){
            echo "create admin success";
        }else{
            echo "Error: " . $result . "<br>" . $conn->error;
        }
    }
?>