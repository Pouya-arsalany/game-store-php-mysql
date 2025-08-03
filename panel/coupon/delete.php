<?php
require "../../assets/connection.php";

$conn = connect();

$coupon_id = isset($_GET['coupon_id']) ? intval($_GET['coupon_id']) : 0;

if ($coupon_id > 0) {
    $sql = "DELETE FROM coupon WHERE coupon_id = $coupon_id";

    if (mysqli_query($conn, $sql)) {
        header("Location: coupon.php?delete=success");
        exit();
    } else {
        echo "Error deleting coupon: " . mysqli_error($conn);
    }
} else {
    echo "Invalid coupon ID";
}

mysqli_close($conn);
?>
