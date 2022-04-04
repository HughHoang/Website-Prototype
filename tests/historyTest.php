<?php
require_once 'src/fuelquoteshistory.php';

use PHPUnit\Framework\TestCase;

class historyTest extends TestCase
{
  function testTable(){
      $conn = mysqli_connect("localhost", "root", "", "fuel");
      if ($conn->connect_error) {
          die("Connection failed: " . $conn->connect_error);
      }
      
      $result = createTable(array('gallons'=>123123, 'deliveryAdd'=>'112334', 'deliveryDate'=>0000-00-00, 'price'=>213123, 'totalDue'=>214123213));
      $this -> assertEquals($result,1);
  }

 
}