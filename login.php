<?php
include "connect.php";
session_start();

if(isset($_SESSION['user']) && isset($_SESSION['id'])){
    header('Location: home.php');
}

ob_start();
$login = file_get_contents('login.html');
echo $login;

if(isset($_GET['message'])){
    echo "<p style=\"color:rgb(0,255,0);\">".$_GET['message']."</p>";
}

if(isset($_POST['butlogin'])){
    $uname = mysqli_real_escape_string($conn,$_POST['username']);
    $password = mysqli_real_escape_string($conn,$_POST['password']);
                
    if ($uname != "" && $password != ""){
        $sql_query = "SELECT id, password FROM usercredentials WHERE username='".$uname."'";
        $result=mysqli_query($conn,$sql_query);
        
        if(mysqli_num_rows($result)  == 1){
            $account=mysqli_fetch_array($result);
            $hashed_password = $account['password'];
            if(password_verify($password, $hashed_password)){
                $id=$account['id'];
                
                $result = mysqli_query($conn,"SELECT * FROM clientinformation WHERE id=".$id."");
                $rows=mysqli_fetch_array($result);
    
                if(mysqli_num_rows($result) == 0){
                    header('Location: profilemanagement.php');
                    $_SESSION['user'] = $uname;
                    $_SESSION['id'] = $id;
                    ob_end_flush();
                }else{
                    header('Location: home.php');
                    $_SESSION['user'] = $uname;
                    $_SESSION['id'] = $id;
                    $_SESSION['info'] = $rows;
                    ob_end_flush();
                }
            }else{
                echo "<p style=\"color:rgb(255,0,0);\">Incorrect password.</p>";
            }
        }else{
            echo "<p style=\"color:rgb(255,0,0);\">Invalid username.</p>";
        }
    }
        
}

?>