<?php
    include("../../Connect.php");

    if (isset($_POST['update'])) {
        $id = $_POST['id'];

        $name=$_POST['name'];
        $phone=$_POST['phone'];
        $branch=$_POST['branch'];
        $alamat=$_POST['address'];

        $result = mysqli_query($conn, "UPDATE supplier SET name='$name',phone='$phone',branch='$branch',address='$alamat' WHERE id=$id");

        if($result){
            header("Location: /eoq/pages/reseller/index.php");
            echo "update succesfully";
        }
        else{
            echo "update Error";
            echo "Error: " . $result . "<br>" . $conn->error;
        }
    }
?> 