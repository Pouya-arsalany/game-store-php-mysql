<?php 
require "../../assets/connection.php";

$conn = connect();

$title = $_POST['title'];
var_dump($_FILES["image"]);
$target_file = "../../assets/uploaded/" . basename($_FILES["image"]["name"]);
move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);

$path = "assets/uploaded/" . basename($_FILES["image"]["name"]);

$sql = "INSERT INTO categories (title, image)
VALUES ('$title', '$path')";

if (mysqli_query($conn, $sql)) {
  header("Location: index.php");
} else {
  echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}
?>