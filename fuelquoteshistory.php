<?php
include('connect.php');
session_start();

if(!(isset($_SESSION['user']))){
    header('Location: login.php');
}else if(!(isset($_SESSION['info']))){
    header('Location: profilemanagement.php');
}else{
    $hist = file_get_contents('fuelquoteshistory.html');
    echo $hist;


    if(isset($_SESSION['history'])){
        echo "<table class=\"center\" border=1>";  

        for ($row = 0; $row < count($_SESSION['history']); $row++) {
            echo "<tr>";
            
            echo "<td>".$_SESSION['history'][$row][0]."</td>";
            echo "<td class = \"address\">".$_SESSION['history'][$row][1]."</td>";
            echo "<td class = \"date\">".$_SESSION['history'][$row][2]."</td>";
            echo "<td>".$_SESSION['history'][$row][3]."</td>";
            echo "<td>".$_SESSION['history'][$row][4]."</td>";

            echo "</tr>";
        }
        echo "</table>";
    }
}
?>