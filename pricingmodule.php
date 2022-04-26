<?php
include('connect.php');
session_start();


ob_start();
$fuelquoteform = file_get_contents('fuelquoteform.html');
echo $fuelquoteform;

//if fuel submit is pressed assign values
if(isset($_POST['butfuelsubmit'])){
    $gallonsrequested = mysqli_real_escape_string($conn,$_POST['requested']);
    $deliveryAdd = mysqli_real_escape_string($conn,$_POST['address1']);
    $deliveryDate = mysqli_real_escape_string($conn,$_POST['delliverydate']);
    $id = $_SESSION['id'];
    
    //if input is not null run
    if ($gallonsrequested != "" && $deliveryAdd != "" && !is_null($deliveryDate)){
      //sql query if in state TX return 1 else 0
      $sql_query = "SELECT id, state FROM clientinformation WHERE state = 'TX' AND id='".$id."' ";
      $result=mysqli_query($conn,$sql_query);
      if(mysqli_num_rows($result)  == 1){
        $LocationFactor=0.02;
      }
      else{
        $LocationFactor=0.04;
      }

      //sql query if there is any previous fuel quote in db
      $result = mysqli_query($conn,"SELECT * FROM fuelquote WHERE userID=".$id."");
      if(mysqli_num_rows($result)!=0){
        $RateHistory=0.01;
      }
      else{
        $RateHistory=0;
      }

      //if gallons more than 1000
      if($gallonsrequested>1000){
        $GallonsFactor=0.02;
      }
      else{
        $GallonsFactor=0.03;
      }
      //constants
      $CurrentPrice=1.5;
      $CompanyProfitFactor=0.1;
      //calculations
      $Margin= $CurrentPrice * ($LocationFactor - $RateHistory + $GallonsFactor + $CompanyProfitFactor);
      $SuggestedPrice = $CurrentPrice + $Margin;
      $total=$gallonsrequested*$SuggestedPrice;
      //assign orderid based on number of rows
      $result = mysqli_query($conn,"SELECT * FROM fuelquote WHERE userID=".$id."");
      $orderid= mysqli_num_rows($result)+1;
      //update db
      mysqli_query($conn, "INSERT INTO fuelquote VALUES (
        '$orderid',  '$id', '$gallonsrequested', '$deliveryAdd	',
        '$deliveryDate', '$SuggestedPrice', '$total	')");
    }
  }
  //output price and total
?>
<html>
<body>
  
        <div>
            <p>Suggested Price / gallon:</p>
            <?php echo $SuggestedPrice; ?>
        </div>
        <div>
            <p>Total Amount Due: </p>
            <?php echo $total; ?>
        </div>

</body>
</html>
