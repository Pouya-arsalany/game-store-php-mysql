<?php session_Start();
require "assets/connection.php";
$conn = connect();  ?>
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
<?php 

if(isset($_GET['search'])) {
  $search = $_GET['search'];
  $sql2 = "SELECT products.*, categories.title AS category_name
  FROM products
  JOIN categories ON products.category_id = categories.category_id where products.product_title like '%$search%' OR categories.title like '%$search%'";
} elseif(isset($_GET['category'])) {
  $category = $_GET['category'];
  $sql2 = "SELECT products.*, categories.title AS category_name
        FROM products
        JOIN categories ON products.category_id = categories.category_id Where products.category_id = '$category' ";
}
else {
  $sql2 = "SELECT products.*, categories.title AS category_name
        FROM products
        JOIN categories ON products.category_id = categories.category_id";
}

$products = mysqli_query($conn, $sql2);

$sql = "SELECT * FROM categories";
$result = mysqli_query($conn, $sql);

if (!$products) {
  die("Database query failed: " . mysqli_error($conn));
}
?>
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
            <a class="header-links" href="#">تماس با ما</a>
            <form class="search-form d-flex align-items-center" method="get" action="index.php">
    <input type="text" name="search" placeholder="جستجو..." title="Enter search keyword" class="form-control bg-dark border-0 text-white" style="border-radius: 20px; font-size: 1rem;"/>
    <button type="submit" title="Search" class="btn btn-dark border-0" style="font-size: 1rem; border-radius: 20px;"><i class="bi bi-search text-white"></i></button>
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
    <!-- headline -->
    <div class="col-10">
      <p style="font-weight: 1000; font-size: x-large; color: white">
        خرید گیفت کارت
      </p>
      <p class="white">گیفت کارت خود را انتخاب کنید و اتوماتیک تحویل بگیرید</p>
    </div>
    <!-- categories -->
    <div class="col-10">
      <div class="product-container">
                        <?php 
                                if (mysqli_num_rows($result) > 0) {
                                  while($row = mysqli_fetch_assoc($result)) {
                                    echo "<div class='col-3'>
                                   <a href='/shopping website/index.php?category=". $row['category_id'] ."'>
                                    <div class='products'> 
                                      <div> 
                                         <img src='". $row["image"] ."'>
                                       </div>
                                   <div style='font-weight: lighter; color: white'>
                                       ". $row["title"] ."
                                       </div>    
                                    </div></a>
                                    </div>";  
                                  }
                                } else {
                                  echo "0 results";
                                }
                                ?>
        
      </div>
    </div>
    <!-- charge -->
    <div class="col-10">
      <p
        style="
          font-weight: 1000;
          font-size: x-large;
          margin-right: 15px;
          color: white;
        "
      >
        محصولات
      </p>
    </div>
    <!-- products -->
    <div class="col-10">
    <div
        class="container-2"
        style="display: flex; flex-wrap: nowrap; gap: 10px; width: 100%"
      >
      <?php 
if (mysqli_num_rows($products) > 0) {
    while ($product = $products->fetch_assoc()) {
        echo "<div class='studies-picture col-3'>
                <div class='studies'>
                    <img src='". $product["image"] ."' alt='Product Image'>
                    <p class='white green-text'>".$product['product_title']."</p>
                    <p class='small'>".$product['description']."</p>
                    <div style='text-decoration: none; color: orangered; display: flex; align-items: center; justify-content: center;'>
                        ".$product['price']."$ 
                    </div>";

        if (isset($_SESSION['admin']) || isset($_SESSION['user'])) {
            echo "<a href='addToCart.php?product_id=" . $product["product_id"] . "' class='btn btn-success'>Add</a>";
        }

        echo "</div>
              </div>";
    }
} else {
    echo "No products found.";
}
?>


      </div> 
    </div>
    <!-- steam wallet -->
    <div class="col-10">
      <div
        style="
          margin-top: 30px;
          margin-bottom: 30px;
          display: flex;
          flex-direction: row;
          justify-content: space-between;
        "
      >
        <div class="col-8">
          <div
            style="
              background-color: #191f2b;
              height: 60px;
              display: flex;
              align-items: center;
              border-radius: 4px;
            "
          >
            <p class="big-words" style="margin-right: 10px">
              خرید گیفت کارت استیم والت گلوبال
            </p>
          </div>
        </div>
        <div class="col-3">
          <button
            style="
              width: 90%;
              background-color: #fdd301;
              height: 60px;
              display: flex;
              align-items: center;
              border-radius: 4px;
              flex-direction: row;
            "
          >
            <i
              class="fa-solid fa-globe fa-lg"
              style="color: #191f2b; margin-right: 10px; margin-left: 10px"
            ></i>
            <p style="color: #191f2b">تغییر ریجن به همه جا ...</p>
          </button>
        </div>
      </div>
    </div>
    <!-- steam regions -->
    <div class="col-10">
      <div
        style="
          display: flex;
          flex-direction: row;
          gap: 10px;
          flex-wrap: wrap;
          margin-bottom: 30px;
        "
      >
        <button class="region-buttons">
          گلوبال <img src="assets/img/global.png" alt="" />
        </button>
        <button class="region-buttons">
          آمریکا<img src="assets/img/usa.png" alt="" />
        </button>
        <button class="region-buttons">
          اکراین <img src="assets/img/ukraine.png" alt="" />
        </button>
        <button class="region-buttons">
          ترکیه<img src="assets/img/turk.png" alt="" />
        </button>
        <button class="region-buttons">
          آرژانتین<img src="assets/img/argantine.png" alt="" />
        </button>
        <button class="region-buttons">
          چین<img src="assets/img/china.png" alt="" />
        </button>
        <button class="region-buttons">تغییر ریجن</button>
        <button class="region-buttons">خرید اکانت استیم</button>
        <button class="region-buttons">
          هند<img src="assets/img/india.png" alt="" />
        </button>
        <button class="region-buttons">
          اروپا<img src="assets/img/uroupe.png" alt="" />
        </button>
        <button class="region-buttons">
          انگلیس<img src="assets/img/britain.png" alt="" />
        </button>
        <button class="region-buttons">
          برزیل<img src="assets/img/brazil.png" alt="" />
        </button>
        <button class="region-buttons">
          ترکیه<img src="assets/img/turk.png" alt="" />
        </button>
        <button class="region-buttons">
          آرژانتین<img src="assets/img/argantine.png" alt="" />
        </button>
        <button class="region-buttons">
          چین<img src="assets/img/china.png" alt="" />
        </button>
      </div>
    </div>
    <!-- global prices -->
    <div class="col-10">
      <div class="container-2" style="display: flex; justify-content: space-around;">
        <div class="col-3">
          <div class="region-price">
            <img style="border-radius: 10px" src="assets/img/global1.png" />
            <p style="color: white">
              استیم والت گلوبال&nbsp;<span style="color: #fdd301"
                >0.49 دلاری</span
              >
            </p>
            <p style="color: white">
              قیمت :&nbsp;<span
                style="text-decoration: line-through; color: #fdd301"
                >65,602</span
              >&nbsp;62,322&nbsp;تومان &nbsp;
            </p>
            <p style="color: white; display: flex; align-items: center">
              <img src="assets/img/flash.png" alt="" />&nbsp; تحویل : فوری
            </p>
            <button class="yellow-btn">افزودن به سبد خرید</button>
          </div>
        </div>

        <div class="col-3">
          <div class="region-price">
            <img style="border-radius: 10px" src="assets/img/global2.png" />
            <p style="color: white">
              استیم والت گلوبال&nbsp;<span style="color: #fdd301"
                >1.13 دلاری</span
              >
            </p>
            <p style="color: white">
              قیمت :&nbsp;<span
                style="text-decoration: line-through; color: #fdd301"
                >131,200</span
              >&nbsp;124,645&nbsp;تومان &nbsp;
            </p>
            <p style="color: white; display: flex; align-items: center">
              <img src="assets/img/flash.png" alt="" />&nbsp; تحویل : فوری
            </p>
            <button class="yellow-btn">افزودن به سبد خرید</button>
          </div>
        </div>

        <div class="col-3">
          <div class="region-price">
            <img style="border-radius: 10px" src="assets/img/global3.png" />
            <p style="color: white">
              استیم والت گلوبال&nbsp;<span style="color: #fdd301"
                >2.25 دلاری</span
              >
            </p>
            <p style="color: white">
              قیمت :&nbsp;<span
                style="text-decoration: line-through; color: #fdd301"
                >262,410</span
              >&nbsp;249,290&nbsp;تومان 
            </p>
            <p style="color: white; display: flex; align-items: center">
              <img src="assets/img/flash.png" alt="" />&nbsp; تحویل : فوری
            </p>
            <button class="yellow-btn">افزودن به سبد خرید</button>
          </div>
        </div>
      </div>
    </div>
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
