<?php 
require "../../assets/connection.php";

$conn = connect();

$title = $_POST['product_title'];
$category_id = $_POST['category_id'];
$price = $_POST['product_price'];
$description = $_POST['product_description'];

var_dump($_FILES["image"]);
$target_file = "../../assets/uploaded_products/" . basename($_FILES["image"]["name"]);
move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);

$path = "assets/uploaded_products/" . basename($_FILES["image"]["name"]);


$sql = "INSERT INTO products (product_title, price,description,image , category_id)
        VALUES ('$title', '$price', '$description','$path', '$category_id')";

if (mysqli_query($conn, $sql)) {
  header("Location: product.php");
} else {
  echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}
?>
