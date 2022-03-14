<?php
include('connect.php');
session_start();


if(!(isset($_SESSION['user']))){
    header('Location: login.php');
}else{
    $profile = file_get_contents('profilemanagement.html');
    echo $profile;
    if(isset($_POST['butprofileset'])){
        
        /*$fullname = mysqli_real_escape_string($con,$_POST['fullName']);
        $firstaddress = mysqli_real_escape_string($con,$_POST['firstaddress']);
        $secondaddress = mysqli_real_escape_string($con,$_POST['secondaddress']);
        $city = mysqli_real_escape_string($con,$_POST['city']);
        $state = mysqli_real_escape_string($con,$_POST['state']);
        $zipcode= mysqli_real_escape_string($con,$_POST['zipcode']);*/
        

        //if username and password arent empty
        if ($fullname != "" && $firstaddress != ""&& $secondaddress != ""&& $city != ""&& $state != ""&& $zipcode != ""){
            // make sure the password is above 5 characters and dont include illegal characters
            if (mysqli_num_rows($query) == 0){
                $id = $length;
                //insert into database
                mysqli_query($conn, "INSERT INTO clientinformation VALUES (
                    '{$fullname}', '{$firstaddress}',  '{$secondaddress}',  '{$city}',  '{$state}',  '{$zipcode}'
                )");
                
                // verify the user's account was created
                $query = mysqli_query($conn, "SELECT * FROM clientinformation WHERE fullname='{$fullname}'");
                if (mysqli_num_rows($query) == 1){
                    $success = true;
                }
                else
                    $error_msg = 'An error occurred and your account was not created.';
            }
            }
        else
            $error_msg = 'Please fill out all required fields.';
        }

}
?>