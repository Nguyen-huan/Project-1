<?php
session_start();  
  include "main.php";
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="./css/style_add_new.css" />
    <title>Document</title>
  </head>
  <body>
    <div class = "nav-home">
      <p>You are <span>Admin</span></p>
      <div>
        <p class = "name">
          Hello,
          <?php echo $_SESSION['name']?>
        </p>
        <a href="logout.php">Logout</a>
      </div>
    </div>
    <div class = "container">
      <div class="box content-left">
        <p class = "title">Admin Menu</p>
        <ul>
          <li>Cấu hình</li>
          <li>tin tức</li>
          <li>sản phẩm</li>
          <li>đơn hàng</li>
        </ul>
      </div>
      <div class="box content-right">
        <p class = "title">Danh sách sản phẩm</p>
        <a href="" id = "btn-them">Thêm Sản phẩm</a>
      </div>
    </div>
  </body>
</html>
