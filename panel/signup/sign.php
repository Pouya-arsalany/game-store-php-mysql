<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>خرید گیفت کارت</title>
    <link rel="stylesheet" href="../../assets/css/styles.css" />
    <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="../../assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="../../assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="../../assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="../../assets/vendor/quill/quill.snow.css" rel="stylesheet">
  <link href="../../assets/vendor/quill/quill.bubble.css" rel="stylesheet">
  <link href="../../assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="../../assets/vendor/simple-datatables/style.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="../../assets/css/style.css" rel="stylesheet">
  <style>
    .form-container { max-width: 500px; margin: auto; padding: 20px; background-color: #191f2b; color: #f5f5f5; border-radius: 8px;box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);}</style>
  </head>
<?php 
require "../../assets/connection.php";
$conn = connect();
?>
  <body class="background">
    <!-- header -->
    <div class="col-12">
      <div class="box">
        <div class="col-2">
          <div class="headr">
            <p style="color: #f5f5f5; ">۰۲۱-۲۸۴۲۵۱</p>
            &nbsp;
            <button onclick="openModal()" class="button-join">
              <i
                class="fa-solid fa-arrow-right-to-bracket"
                style="color: #f5f5f5"
              ></i
              >&nbsp;ورود به حساب
            </button>
            <div id="popup" class="modl">
              <div class="modl-content">
                  <span class="close-btn" onclick="closeModal()">&times;</span>
                  <h2>ورود به سایت</h2>
                  <form method="get" action="index.php">
                  <p>نام کاربری</p>
                  <input class="text-white" type="text" value="" name="username" style="border-radius: 8px; background-color:gray">
                  <p>رمز عبور</p>
                  <input class="text-white" type="text" value="" name="password" style="border-radius: 8px; background-color: gray">
                  <br><br>
                  <button type="submit" class="yellow-btn-2"> ورود </button><br><br>
                  <a style="color:cyan" href="#">ثبت نام</a>
                  </post>
              </div>
          </div>
          </div>
        </div>
        <div class="col-6">
          <div class="links">
            <a class="header-links" href="../../index.php">صفحه اصلی</a>
            <a class="header-links" href="../index.php">ادمین</a>
            <a class="header-links" href="#">نحوه شارژ</a>
            <a class="header-links" href="#">بلاگ</a>
            <a class="header-links" href="./contact-us.html">تماس با ما</a>
            <form class="search-form d-flex align-items-center" method="get" action="index.php">
    <input type="text" name="search" placeholder="جستجو..." title="Enter search keyword" class="form-control bg-dark border-0 text-white" style="border-radius: 20px; width: 20%; font-size: 1rem;"/>
    <button type="submit" title="Search" class="btn btn-dark border-0" style="font-size: 1rem; border-radius: 20px;"><i class="bi bi-search text-white"></i></button>
</form>

<style>
    .search-form input::placeholder {color: lightgray;  font-size: 0.9rem; opacity: 1; }
</style>
          </div>
        </div>
        <div class="col-2">
          <a href="./index.html" class="res"
            ><img style="height: 98px" src="../../assets/img/brand.png"
          /></a>
        </div>
      </div>
    </div>
    <!-- hidden list for shorter screens-->
    <div class="col-10">
      <div class="links-2">
        <a class="header-links" href="./index.html">صفحه اصلی</a>
        <a class="header-links" href="#">قوانین</a>
        <a class="header-links" href="#">نحوه شارژ</a>
        <a class="header-links" href="#">بلاگ</a>
        <a class="header-links" href="./contact-us.html">تماس با ما</a>
        <a class="header-links2" href="#"><p>وب سرویس - api</p></a>
      </div>
    </div>
    <!-- sign up -->
    <div class="container my-5">
    <div class="form-container">
      <h2 class="text-center mb-4">ثبت نام</h2>
      <form method="post" action="store.php">
        <div class="mb-3">
          <label for="username" class="form-label">نام کاربری</label>
          <input type="text" class="form-control"  name="username"  required>
        </div>

        <div class="mb-3">
          <label for="password" class="form-label">رمز عبور</label>
          <input type="password" class="form-control"  name="password"  required>
        </div>

        <div class="mb-3">
          <label for="repeat_password" class="form-label">تکرار رمز عبور</label>
          <input type="password" class="form-control"  name="repeatpassword"  required>
        </div>

        <button type="submit" class="btn btn-primary w-100">ثبت نام</button>
      </form>
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
            ><img class="round" src="../../assets/img/nemad.png" alt=""
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
  <script src="../../assets/vendor/apexcharts/apexcharts.min.js"></script>
  <script src="../../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="../../assets/vendor/chart.js/chart.umd.js"></script>
  <script src="../../assets/vendor/echarts/echarts.min.js"></script>
  <script src="../../assets/vendor/quill/quill.js"></script>
  <script src="../../assets/vendor/simple-datatables/simple-datatables.js"></script>
  <script src="../../assets/vendor/tinymce/tinymce.min.js"></script>
  <script src="../../assets/vendor/php-email-form/validate.js"></script>

  <script>
    function openModal() {
    document.getElementById("popup").style.display = "block";
}

function closeModal() {
    document.getElementById("popup").style.display = "none";
}
  </script>
</html>
