<?php

include "connect.php";
session_start();

if(isset($_SESSION['user'] )){
    header('Location: home.php');
}else{
    $login = file_get_contents('login.html');
    echo $login;
    if(isset($_POST['butlogin'])){
       
        #$uname = mysqli_real_escape_string($con,$_POST['username']);
        #$password = mysqli_real_escape_string($con,$_POST['password']);
        
        $uname = $_POST['username'];
        $password = $_POST['password'];
                
        if ($uname != "" && $password != ""){

            /*$sql_query = "select count(*) as cntUser from users where username='".$uname."' and password='".$password."'";
            $result = mysqli_query($con,$sql_query);
            $row = mysqli_fetch_array($result);

            $count = $row['cntUser'];

            if($count > 0){
                $_SESSION['uname'] = $uname;
                header('Location: home.php');
                }else{
                    echo "Invalid username and password";
                }
            }*/
            
            if($uname == "admin" && $password == "password"){
                $_SESSION['user'] = $uname;
                header('Location: home.php');
            }else{
                echo "<p style=\"color:rgb(255,0,0);\">Invalid username and password</p>";
            }
        }
    }
}
?>
