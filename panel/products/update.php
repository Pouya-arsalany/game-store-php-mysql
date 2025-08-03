<?php 
require "../../assets/connection.php";

$conn = connect();

$product_id   = $_POST['product_id'];
$title        = $_POST['title'];
$category_id  = $_POST['category_id'];
$price        = $_POST['price'];
$description  = $_POST['description'];
$existingImage = $_POST['existing_image'];


if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
    $imageName = basename($_FILES["image"]["name"]);
    $uploadDir = "../../assets/uploaded_products/";
    $target_file = $uploadDir . $imageName;

    move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);

    $imagePath = "assets/uploaded_products/" . $imageName;
} else {
    $imagePath = $existingImage;
}

$sql = "UPDATE products 
        SET product_title = '$title',
            price = '$price', 
            description = '$description',
             image = '$imagePath',
            category_id = '$category_id'
        WHERE product_id = '$product_id'";

mysqli_query($conn, $sql);

header("Location: product.php");
exit();
?>
