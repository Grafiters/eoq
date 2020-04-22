<?php
    session_start();
    session_destroy();

    header('Location: /eoq/pages/auth/login.php');
?>