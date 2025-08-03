<?php 
session_start();

require "assets/connection.php";

$conn = connect();

$action = $_GET['action'] ?? null;
$item_id = $_GET['item_id'];
$user_id = $_SESSION['user_id'];

$query = "SELECT * FROM products WHERE product_id = $item_id";
$result = mysqli_query($conn, $query); 
$product = mysqli_fetch_assoc($result); 

$getCart = mysqli_query($conn, "SELECT cart_id FROM carts WHERE user_id = $user_id");
$cartData = mysqli_fetch_assoc($getCart);
$cart_id = $cartData['cart_id'];


if ($action === 'inc'){
    
$sql = "UPDATE cart_items SET quantity = quantity + 1 WHERE cart_id = $cart_id AND item_id = $item_id";

mysqli_query($conn,$sql); 
header("Location: cart.php");

}
elseif($action === 'dec')
{
    $sql = "UPDATE cart_items SET quantity = quantity - 1 WHERE cart_id = $cart_id AND item_id = $item_id";

mysqli_query($conn,$sql); 
header("Location: cart.php");
}
?>