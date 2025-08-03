<?php 
require "../../assets/connection.php";

$conn = connect();

$title = $_POST['title'];
$categoryId = $_POST['category_id'];

$existingImage = $_POST['existing_image'];



if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
    // New image uploaded
    $imageName = basename($_FILES["image"]["name"]);
    $uploadDir = "../../assets/uploaded/";
    $target_file = $uploadDir . $imageName;

    move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);

    $imagePath = "assets/uploaded/" . $imageName;
} else {
    // No new image uploaded, keep the existing one
    $imagePath = $existingImage;
}

$sql = "UPDATE categories SET title = '$title', image = '$imagePath' WHERE category_id = '$categoryId'";


if (mysqli_query($conn, $sql)) {
  header("Location: index.php");
} else {
  echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}
?>

