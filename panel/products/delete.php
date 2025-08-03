<?php
require "../../assets/connection.php";

$conn = connect();

$product_id = isset($_GET['product_id']) ? intval($_GET['product_id']) : 0;

if ($product_id > 0) {
    $sql = "DELETE FROM products WHERE product_id = $product_id";
    if (mysqli_query($conn, $sql)) {
        header("Location: product.php?delete=success");
        exit();
    } else {
        echo "Error deleting product: " . mysqli_error($conn);
    }
} else {
    echo "Invalid product ID";
}

mysqli_close($conn);
?>
