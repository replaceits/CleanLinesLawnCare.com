<?php
    session_start();
    session_unset();
    session_destroy();
    if(isset($_SESSION['email'])){
        unset($_SESSION['email']);
    }
    header('Location: ' . dirname($_SERVER['REQUEST_URI']) . "/login/");
    exit(0);
?>