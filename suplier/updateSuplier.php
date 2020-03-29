<?php
    include_once("../Connect.php");

    if (isset($_POST['update'])) {
        $id = $_POST['supplier_id'];

        $name=$_POST['name'];
        $phone=$_POST['phone'];
        $address=$_POST['address'];
        $branch=$_POST['branch'];

        $result = mysqli_query($conn, "UPDATE supplier SET name='$name',phone='$phone',address='$address',branch='$branch' WHERE supplier_id=$id");

        if($result){
            header("Location: index.php");
        }
        else{
            echo "Error: " . $result . "<br>" . $conn->error;
        }
    }
?>