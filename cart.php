<?php session_Start();
require "assets/connection.php";
$conn = connect();

$user_id = $_SESSION['user_id'];
$userId = (int) $_SESSION['user_id'];
$items = [];

$cartQ = mysqli_query($conn, "SELECT cart_id FROM carts WHERE user_id = $userId LIMIT 1");
if ($cartQ && $cartRow = mysqli_fetch_assoc($cartQ)) {
  $cartId = $cartRow['cart_id'];
  $itemsQ = mysqli_query($conn, "
    SELECT cart_items.item_id, cart_items.quantity, products.product_title, products.price, products.image
    FROM cart_items
    JOIN products ON cart_items.product_id = products.product_id
    WHERE cart_items.cart_id = $cartId
  ");
  $items = mysqli_fetch_all($itemsQ, MYSQLI_ASSOC);
}
// total price

$total=0;

$getCart = mysqli_query($conn, "SELECT cart_id FROM carts WHERE user_id = $user_id");
$cartData = mysqli_fetch_assoc($getCart);
$cart_id = $cartData['cart_id'];
$res = mysqli_query($conn, "SELECT cart_items.quantity, products.price
FROM cart_items
JOIN products ON cart_items.product_id = products.product_id
WHERE cart_items.cart_id = $cart_id");

while($row=mysqli_fetch_assoc($res)){
$quantity=$row['quantity'];
$price=$row['price'];
$total += $quantity * $price;
}

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>خرید گیفت کارت</title>
    <link rel="stylesheet" href="assets/css/styles.css" />
    <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/quill/quill.snow.css" rel="stylesheet">
  <link href="assets/vendor/quill/quill.bubble.css" rel="stylesheet">
  <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="assets/vendor/simple-datatables/style.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">
  </head>

  <body class="background">
    <!-- header -->
    <div class="col-12">
      <div class="box">
        <div class="col-2">
          <div class="headr">
            <?php
            if(isset($_SESSION['admin']) || isset($_SESSION['user'])){
            echo"
<button onclick=\"window.location.href='cart.php'\" class='button-join' style='display: flex; align-items: center; justify-content: center; width: 15%; background-color: gold; height: 40px;'>Cart</button>
            </button>
               &nbsp;
              <button onclick=\"window.location.href='panel/signup/logout.php'\" class='button-join' style='display: flex; align-items: center; justify-content: center; width: 25%; background-color: red; height: 40px;'>
              خروج
            </button>";
            
            ;}
            else{
              
            }
            ?>

            &nbsp;

            <?php
if (isset($_SESSION['admin'])) {
    echo "
    <button onclick='openModal()' class='button-join' >
        <i class='fa-solid fa-arrow-right-to-bracket' style='color: #f5f5f5'></i>
        &nbsp; admin " . $_SESSION['admin'] . "
    </button>";
} else if (isset($_SESSION['user'])) {
    echo "
    <button onclick='openModal()' class='button-join'>
        <i class='fa-solid fa-arrow-right-to-bracket' style='color: #f5f5f5'></i>
        &nbsp; user " . $_SESSION['user'] . "
    </button>";
} else {
    echo "
    <button onclick='openModal()' class='button-join'>
        <i class='fa-solid fa-arrow-right-to-bracket' style='color: #f5f5f5'></i>
         ورود به حساب
    </button>";
}
?>
            <div id="popup" class="modl" >
              <div class="modl-content">
                  <span class="close-btn" onclick="closeModal()">&times;</span>
                  <h2>ورود به سایت</h2>
                  <form method="post" action="panel/signup/check.php">
                  <p>نام کاربری</p>
                  <input class="text-white" type="text" value="" name="username" style="border-radius: 8px; background-color:gray">
                  <p>رمز عبور</p>
                  <input class="text-white" type="text" value="" name="password" style="border-radius: 8px; background-color: gray">
                  <br><br>
                  <button type="submit" class="yellow-btn-2"> ورود </button><br><br>
                  </form>
                  <a style="color:cyan" href="panel/signup/sign.php">ثبت نام</a>
                  
              </div>
          </div>
          </div>
        </div>
        <div class="col-6">
          <div class="links">
            <a class="header-links" href="./index.php">صفحه اصلی</a>
            <?php if(isset($_SESSION['admin'])){echo "
            <a class='header-links' href='./panel/categories/index.php'>ادمین</a>";
            }
            ?>
            <a class="header-links" href="#">نحوه شارژ</a>
            <a class="header-links" href="#">بلاگ</a>
            <a class="header-links" href="./contact-us.html">تماس با ما</a>
            <form class="search-form d-flex align-items-center" method="get" action="index.php" >
    <input type="text" name="search" placeholder="جستجو..." title="Enter search keyword" class="form-control bg-dark border-0 text-white" style="border-radius: 20px; font-size: 1rem;"/ disabled>
    <button type="submit" title="Search" class="btn btn-dark border-0" style="font-size: 1rem; border-radius: 20px;" disabled><i class="bi bi-search text-white"></i></button>
</form>

<style>
    .search-form input::placeholder {color: lightgray;  font-size: 0.9rem; opacity: 1; }
</style>
          </div>
        </div>
        <div class="col-2">
          <a href="./index.html" class="res"
            ><img style="height: 98px" src="assets/img/brand.png"
          /></a>
        </div>
      </div>
    </div>
    <!-- hidden list for shorter screens-->
    <div class="col-10">
      <div class="links-2">
        <a class="header-links" href="index.php">صفحه اصلی</a>
        <?php if(isset($_SESSION['admin'])){echo "
            <a class='header-links' href='./panel/categories/index.php'>ادمین</a>";
            }
            ?>
        <a class="header-links" href="#">نحوه شارژ</a>
        <a class="header-links" href="#">بلاگ</a>
        <a class="header-links" href="./contact-us.html">تماس با ما</a>
        <form class="search-form d-flex align-items-center" method="get" action="index.php">
    <input type="text" name="search" placeholder="جستجو..." title="Enter search keyword" class="form-control bg-dark border-0 text-white" style="border-radius: 20px; font-size: 1rem;"/>
    <button type="submit" title="Search" class="btn btn-dark border-0" style="font-size: 1rem; border-radius: 20px;"><i class="bi bi-search text-white"></i></button>
</form>      </div>
    </div>
    <!-- cart -->
<div class="col-10">
    <div style="background-color: #191f2b; display: flex; align-items: center; border-radius: 4px; width: 100%; padding: 10px;">
        <table border="1" cellspacing="0" cellpadding="10" style=" width: 100%; text-align: center; border-collapse: collapse;">
            <thead >
                <tr style="color: green;">
                    <th>عکس</th>
                    <th>اسم</th>
                    <th>تعداد</th>
                    <th>قیمت</th>
                    <th>عملیات</th>
                </tr>
            </thead>
            <tbody>
<?php
if (empty($items)) {
    echo "<tr><td colspan='4' style='color: white;'>No items in cart</td></tr>";
} else {
    foreach ($items as $it) {
        echo "<tr>";
        echo "<td><img style='color:white;' src='" . $it['image'] . "' alt='" . htmlspecialchars($it['product_title']) . "' style='max-width:80px; max-height:80px;'></td>";
        echo "<td style='color: white;'>" . htmlspecialchars($it['product_title']) . "</td>";
        echo "<td style='color: white;'>" . (int)$it['quantity'] . "</td>";
        echo "<td style='color: white;'>" . (int)$it['price'] ."$". "</td>";
        echo "<td>
                <a style='color: yellow;' href='update_cart.php?action=inc&item_id=" . $it['item_id'] . "&qty=" . $it['quantity'] . "'><button class='btn' style='color:white; background-color:green;'>+</button></a> |
                <a style='color: yellow;' href='update_cart.php?action=dec&item_id=" . $it['item_id'] . "&qty=" . $it['quantity'] . "'><button class='btn' style='color:white; background-color:red;'>-</button></a> |
                <a style='color: red;' href='remove_from_cart.php?item_id=" . $it['item_id'] . "'>Remove</a>
              </td>";
        echo "</tr>";
    }
    echo "<tr>";
    echo "<td colspan='3' style='color: yellow; border: 1px solid white; text-align: center; font-weight: bold;'>قیمت کل:</td>";
    echo "<td style='color: yellow; border: 1px solid white; c font-weight: bold;'>" . (int)$total . "$</td>";
    echo "</tr>";}
?>
<tr>
<td colspan="5" style="text-align: center;">
    <form action="apply_coupon.php" method="POST" style="display: inline-block; width: 100%; max-width: 400px;">
        <div class="mb-3" style="display: flex; gap: 10px; justify-content: center;">
            <input type="text" class="form-control" name="coupon_code" required placeholder="کد تخفیف" style="flex: 1; padding: 8px; border-radius: 4px; border: 1px solid #ccc;">
            <button type="submit" class="btn btn-primary" style="background-color: orange; border-color: green; padding: 6px 20px;">ثبت</button>
        </div>
    </form>
</td>
<?php $_SESSION['cart_total'] = $total;
 ?>
 <?php
if (isset($_GET['offed'])) {
    $discounted_total = $_GET['offed'];
} else {
    $discounted_total = $_SESSION['cart_total'];
}
?>

</tr>
<tr>
<td colspan="5" style="text-align: center;"><?php
$off = $_GET['offed'];
$cart_total = $_SESSION['cart_total'] ?? 0;
if($off == $cart_total){
  echo "<p style='color:orangered;'> کد تخفیف وجود ندارد. </p>";
}
 ?></td>
</tr>
<tr>
    <td colspan="3" style="color: yellow; border: 1px solid white; text-align: center; font-weight: bold;">قیمت بعد تخفیف :</td>
    <td style="color: yellow; border: 1px solid white; font-weight: bold;"><?php echo (int)$discounted_total . "$"; ?></td>
</tr>

</tbody>
        </table>
    </div>
</div>



     &nbsp;

    <!-- footer -->
    <div class="col-12">
      <div class="footer-container">
        <div class="col-10">
          <div style="display: flex; flex-direction: row;">
          <div class="col-7">
          <p class="big-words">درباره ما</p>
        </div>

        <div class="col-3">
          <p class="big-words">اینماد</p>
        </div>
      </div>
      </div>
      <div class="col-10">
        <div style="display: flex; flex-direction: row;">
        <div class="col-7">
          <p class="sentences">
            در ابتدا ، فقط گیفتهای استیمو داشتیم ، واسه همین یه جای کوچیک داخل
            فست آیتم ( سایت خرید و فروش آیتمهای دوتا2 و سی اس گو ) برامون کافی
            بود . کم کم هم گیفت کارت هامون کاملتر شد هم کاربرامون بیشتر شد واسه
            همین دیگه تصمیم گرفتیم یه سایت جدا داشته باشیم و همین شد که گیف کارت
            بوجود اومد . منظورمون از گیف کارت همون گیفت کارته ولی چون همه بهش
            میگن گیف کارت و تلفظش اینجوری راحتره ما هم گذاشتیمش گیف کارت .
          </p>
        </div>

        <div class="col-3">
          <a href="#"
            ><img class="round" src="assets/img/nemad.png" alt=""
          /></a>
        </div>
      </div>
        <div class="col-10">
          <a href="#"><i class="fa-brands fa-instagram" style="color:white;"></i></a>
          <a href="#"><i class="fa-brands fa-telegram" style="color: white;"></i></a>
          <a href="#"><i class="fa-brands fa-facebook-f" style="color: white;"></i></a>
        </div>
      </div>
    </div>
    </div>
  </body>
        <!-- Vendor JS Files -->
  <script src="assets/vendor/apexcharts/apexcharts.min.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/chart.js/chart.umd.js"></script>
  <script src="assets/vendor/echarts/echarts.min.js"></script>
  <script src="assets/vendor/quill/quill.js"></script>
  <script src="assets/vendor/simple-datatables/simple-datatables.js"></script>
  <script src="assets/vendor/tinymce/tinymce.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>

  <script>
    function openModal() {
    document.getElementById("popup").style.display = "block";
}

function closeModal() {
    document.getElementById("popup").style.display = "none";
}
  </script>
</html>
