<?php 
require_once("connect.php"); 
    $username="";
    $passwd="";
    //if registerbutton clicked assign values
    if (isset($_POST['registerBtn'])){ 
        $username = $_POST['username']?? '';; 
        $passwd = $_POST['password']?? '';; 
    }
    // check to see if there is a user already logged in, if so redirect them 
    session_start(); 
    if (isset($_SESSION['username']) && isset($_SESSION['userid'])) 
        header("Location: ./home.html");  // redirect the user to the home page

    //if username and password arent empty
    if ($username != "" && $passwd != ""){
        // make sure the password is above 5 characters and dont include illegal characters
        if ( strlen($passwd) >= 5 && strpbrk($passwd, "!#$.,:;()") != false ){
            //query and check if username is not in database
            $query = mysqli_query($conn, "SELECT * FROM usercredentials WHERE username='{$username}'");
            //assigns id based on number of rows in database
            $length= mysqli_query($conn, "SELECT COUNT(*) FROM usercredentials");
            if (mysqli_num_rows($query) == 0){
                $id = $length;
                //insert into database
                mysqli_query($conn, "INSERT INTO usercredentials VALUES (
                    '{$id}', '{$username}',  '{$passwd}'
                )");
                
                // verify the user's account was created
                $query = mysqli_query($conn, "SELECT * FROM usercredentials WHERE username='{$username}'");
                if (mysqli_num_rows($query) == 1){
                    $success = true;
                }
                else
                    $error_msg = 'An error occurred and your account was not created.';
            }
            else
                $error_msg = 'The username <i>'.$username.'</i> is already taken. Please use another.';
            
            }
        else
                $error_msg = 'Your password is not strong enough. Please use another.';
        }
    else
        $error_msg = 'Please fill out all required fields.';

    ?>