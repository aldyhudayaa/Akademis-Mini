<?php
session_start();

if(!isset($_SESSION['login'])){
    header("Location: login.php");
    exit;
}

if($_SESSION['level'] != 'dosen'){
    header("Location: unauthorized.php");
    exit;
}
?>