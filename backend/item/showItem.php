<?php
    include("../../Connect.php");

    $items = mysqli_query($conn, "SELECT * FROM barang");

?>