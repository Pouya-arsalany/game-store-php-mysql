<?php
session_start();

require "assets/connection.php";

$conn = connect();

if (isset($_GET['item_id']) && isset($_SESSION['user_id'])) {
    $itemId = (int) $_GET['item_id'];
    $userId = (int) $_SESSION['user_id'];

    $cartQ = mysqli_query($conn, "SELECT cart_id FROM carts WHERE user_id = $userId LIMIT 1");
    if ($cartQ && $cartRow = mysqli_fetch_assoc($cartQ)) {
        $cartId = $cartRow['cart_id'];
        mysqli_query($conn, "DELETE FROM cart_items WHERE item_id = $itemId AND cart_id = $cartId");
    }
}

header("Location: cart.php");
exit;
 ?>