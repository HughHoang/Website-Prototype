<?php
session_start();

include("connect.php");

if(!(isset($_SESSION['user']))){
    header('Location: login.php');
}else if(!(isset($_SESSION['info']))){
    header('Location: profilemanagement.php');
}
else{
    $home = file_get_contents('home.html');
    echo $home;
}
?>