<?php 
require "../../assets/connection.php";

$conn = connect();

$coupon_code = $_POST['coupon_code'];
$discount_type = $_POST['discount_type'];
$discount_value = $_POST['discount_value'];
$max_uses = $_POST['max_uses'];
$expire_date = $_POST['expire_date'];

$sql = "INSERT INTO coupon (code, discount_type, discount_value, max_uses, expire_date)
        VALUES ('$coupon_code', '$discount_type', '$discount_value', '$max_uses', '$expire_date')";

if (mysqli_query($conn, $sql)) {
    header("Location: coupon.php");
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}
?>
