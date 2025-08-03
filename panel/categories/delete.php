<?php 
require "../../assets/connection.php";

$conn = connect();

$id = $_GET['id'];  

$sql_delete_products = "DELETE FROM products WHERE category_id = '$id'";

if (mysqli_query($conn, $sql_delete_products)) {
    $sql_delete_category = "DELETE FROM categories WHERE category_id = '$id'";

    if (mysqli_query($conn, $sql_delete_category)) {
        header("Location: index.php");
    } else {
        echo "Error deleting category: " . mysqli_error($conn);
    }
} else {
    echo "Error deleting products: " . mysqli_error($conn);
}
?>
