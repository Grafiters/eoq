<?php
    include("../../Connect.php");

    if (isset($_POST['submit'])) {
        $name=$_POST['name'];
        $phone=$_POST['phone'];
        $address=$_POST['address'];
        $branch=$_POST['branch'];

        $code = substr("RES")

        $result = mysqli_query($conn, "INSERT INTO supplier(name,phone,address,branch)VALUES('$name','$phone','$address','$branch')");
        
        if($result){
            echo "create admin success";
        }else{
            echo "Error: " . $result . "<br>" . $conn->error;
        }
    }
?>