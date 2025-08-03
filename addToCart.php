<?php 
session_start();

require "assets/connection.php";

$conn = connect();

$product_id = $_GET['product_id'];
$user_id = $_SESSION['user_id'];
$query = "SELECT * FROM products WHERE product_id = $product_id";
$result = mysqli_query($conn, $query); 
$product = mysqli_fetch_assoc($result); 

$query2 = "SELECT cart_id FROM carts WHERE user_id = $user_id";
$result2 = mysqli_query($conn, $query2); 
$product2 = mysqli_fetch_assoc($result2); 

if(mysqli_num_rows($result2) <=0){
$sql="INSERT INTO carts ( user_id) VALUES ( $user_id)";  
mysqli_query($conn, $sql);
$cart_id=mysqli_insert_id($conn);
$sql2="INSERT INTO cart_items (cart_id , product_id , quantity) VALUES ($cart_id , $product_id , 1)";
mysqli_query($conn,$sql2);
}
else if (mysqli_num_rows($result2) >0){
    $getCart = mysqli_query($conn, "SELECT cart_id FROM carts WHERE user_id = $user_id");
    $cartData = mysqli_fetch_assoc($getCart);
    $cart_id = $cartData['cart_id'];
    $checkItem = mysqli_query($conn, "SELECT quantity FROM cart_items WHERE cart_id = $cart_id AND product_id = $product_id");
 if (mysqli_num_rows($checkItem) == 0) {

    $sql2="INSERT INTO cart_items (cart_id , product_id , quantity) VALUES ($cart_id , $product_id , 1)";
    mysqli_query($conn,$sql2);
    header("Location: index.php");}
 else  { 
    $sql2 = "UPDATE cart_items SET quantity = quantity + 1 WHERE cart_id = $cart_id AND product_id = $product_id";
    mysqli_query($conn,$sql2); 
    header("Location: index.php");
}
  }
  else{
    echo"error";
  }
?>