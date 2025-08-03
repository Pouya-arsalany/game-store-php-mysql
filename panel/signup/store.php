<?php 
require "../../assets/connection.php";
$conn = connect();
$username = $_POST['username'];
$password = $_POST['password'];
$repeatpassword = $_POST['repeatpassword'];
$role = 0;

$pattern = "/^[A-Za-z0-9]{5,8}$/";

if(preg_match($pattern,$username) && preg_match($pattern,$password) && preg_match($pattern,$repeatpassword)){
 if($password === $repeatpassword){
  $sql = "INSERT INTO users (username, password, role)
 VALUES ('$username', '$password' , '$role')";
  if (mysqli_query($conn, $sql)) {

   header("Location: ../../index.php");
  } else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
  }
}else{
  echo"wrong repeated password";
}} else {
  echo "match the required pattern [A-Za-z0-9]{5,8} !!!";
}
?>