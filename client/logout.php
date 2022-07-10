<?php
    session_start();
    unset($_SESSION["user_type"]);
    unset($_SESSION["username"]);
    header("Location: ./handleLogin.php");
?>