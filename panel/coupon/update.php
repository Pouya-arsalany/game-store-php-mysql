<?php 
require "../../assets/connection.php";

$conn = connect();

$coupon_id = $_POST['coupon_id'];

$code = $_POST['code'];
$discount_type = $_POST['discount_type'];
$discount_value = $_POST['discount_value'];
$max_uses = $_POST['max_uses'];
$expire_date = $_POST['expire_date'];

$sql = "UPDATE coupon 
        SET code = '$code',
            discount_type = '$discount_type',
            discount_value = '$discount_value',
            max_uses = '$max_uses',
            expire_date = '$expire_date'
        WHERE coupon_id = '$coupon_id'";

if (mysqli_query($conn, $sql)) {
    header("Location: coupon.php?update=success");
    exit();
} else {
    echo "Error updating coupon: " . mysqli_error($conn);
}

mysqli_close($conn);
?>
