<?php
session_start(); 
require "../../assets/connection.php";
$conn = connect();

$username = $_POST['username'];
$password = $_POST['password'];

$sql = "SELECT * FROM users WHERE username = '$username' And password = '$password' ";

$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    $user = mysqli_fetch_assoc($result);
    
    if ($user['role'] == 1) {
        $_SESSION['admin'] = $username;
        $_SESSION['user_id'] = $user['user_id'];
        header("Location: ../../index.php");
        exit();
    } else if ($user['role'] == 0) {
        $_SESSION['user'] = $username;
        $_SESSION['user_id'] = $user['user_id'];
        header("Location: ../../index.php");
        exit();
    } else {
        unset($_SESSION['user']);
        unset($_SESSION['admin']);
        header("Location: ../../index.php");
        exit();
    }
} else {
    header("Location: sign.php");
    exit();}
?>
