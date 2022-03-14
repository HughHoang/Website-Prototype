<?php
include('connect.php');
session_start();

if(!(isset($_SESSION['user']))){
    header('Location: login.php');
}else{
    $hist = file_get_contents('fuelquoteshistory.html');
    echo $hist;

    $fuelhist = array(
        array(1,"1 Street", '1-1-1', 1, 1),
        array(2,"2 Street", '2-2-2', 2, 2),
        array(3,"3 Street", '3-3-3', 3, 3),
    );

    echo "<table class=\"center\" border=1>";  

    for ($row = 0; $row < count($fuelhist); $row++) {
        echo "<tr>";
        
        echo "<td>".$fuelhist[$row][0]."</td>";
        echo "<td class = \"address\">".$fuelhist[$row][1]."</td>";
        echo "<td class = \"date\">".$fuelhist[$row][2]."</td>";
        echo "<td>".$fuelhist[$row][3]."</td>";
        echo "<td>".$fuelhist[$row][4]."</td>";

        echo "</tr>";
    }
    echo "</table>";
}
?>