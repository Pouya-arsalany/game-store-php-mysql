<?php 
session_start();

require "assets/connection.php";

$conn = connect();

$coupon_code = $_POST['coupon_code'];
$og_total = $_SESSION['cart_total'];

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $query2 = "SELECT * FROM coupon WHERE code = '$coupon_code'";
    $result2 = mysqli_query($conn, $query2); 
    if(mysqli_num_rows($result2) > 0){

        $og_coupon = mysqli_fetch_assoc($result2); 
        
    if ($og_coupon['discount_type']=="fixed") {
        $og_total -= $og_coupon['discount_value'];
        header("Location: cart.php?offed=$og_total");
        exit;
    } 
    elseif($og_coupon['discount_type']=="percentage"){
        $og_total -= ($og_total * $og_coupon['discount_value']) / 100;
        header("Location: cart.php?offed=$og_total");
        exit;
    }
    else {
        header("Location: cart.php?offed=$og_total");
    }
  }
  else{
    header("Location: cart.php?offed=$og_total");
  }
}
  else{
    header("Location: cart.php?offed=$og_total");
}

?>