<?php
ob_start();
session_start();


//Shopierdan gelen postlar. 
$status = $_POST["status"];
$invoiceId = $_POST["platform_order_id"];
$transactionId = $_POST["payment_id"];
$installment = $_POST["installment"];
$signature = $_POST["signature"];


$data = $_POST["random_nr"] . $_POST["platform_order_id"] . $_POST["total_order_value"] . $_POST["currency"];
$signature = base64_decode($signature);
$expected = hash_hmac('SHA256', $data, $shopierSecret, true);

  $status = strtolower($status);
 
  if ($status == "success") {
    
      $_SESSION['NotifySfy'] = 1;
      $_SESSION['check'] = 1;
     header("Location: ../../check");
     
        
  }
  else{
      $_SESSION['NotifySfy'] = 3;
      $_SESSION['check'] = 1;
      
header("Location:../../check");
  }
  

?>
