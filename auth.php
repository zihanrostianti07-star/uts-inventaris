<?php 
// dipanggil di paling atas setiap halaman admin
session_start();

if(!isset($_SESSION['session_login'])){
    header('Location: login.php');
    exit;
}

require 'function.php';
?>

