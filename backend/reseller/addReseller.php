<?php
    include_once("../../Connect.php");

    if (isset($_POST['submit'])) {

        $name=$_POST['name'];
        $phone = $_POST['phone'];
        $branch=$_POST['branch'];
        $address=$_POST['address'];

        $query = $conn->query('SELECT MAX(id) as maxId FROM supplier');
        // var_dump($query);
        $hasil = $query->fetch_assoc();
        $idCode = $hasil['maxId'];
        
        $char = "RES";
        $cutName = substr($name, 0, 2);
        $noUrut = (int)substr($idCode, 0, 2);
        $noUrut++;
        if ($noUrut<10) {
            $code = $char."0".$noUrut.strtoupper($cutName);
        }else{
            $code = $char.$noUrut.strtoupper($cutName);
        }
        
        $result = mysqli_query($conn, "INSERT INTO supplier(code,name,phone,branch,address)VALUES('$code','$name','$phone','$branch','$address')");

        if($result){
            echo "add reseller succesfully";
            header("Location: /eoq/pages/reseller/index.php");
        }
        else{
            echo "Error: " . $result . "<br>" . $conn->error;
        }
    }
?>