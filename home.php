<?php 
  session_start();
  echo"login success";
  if(isset($_SESSION['id']) && isset($_SESSION['user_name'])){
  
  
  
?>
<?php
  include "main.php";
?>
<style>
  .error {
    color: #fbceb5 !important; margin-bottom: 20px; margin-top: -10px; margin-left: 20px;
  }
</style>
<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Login 10</title>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1, shrink-to-fit=no"
    />

    <link
      href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap"
      rel="stylesheet"
    />

    <link
      rel="stylesheet"
      href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"
    />

    <link rel="stylesheet" href="css/style.css" />
  </head>
  <body class="img js-fullheight" style="background-image: url(images/bg.jpg)">
    
    <section class="ftco-section">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-md-6 col-lg-4">
            <div class="login-wrap p-0">
              <h1>Hello, <?php echo $_SESSION['name']?></h1>
              <a href="logout.php">Logout</a>
              
            </div>
          </div>
        </div>
      </div>
    </section>

    <script src="js/jquery.min.js"></script>
    <script src="js/popper.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>
  </body>
</html>


<?php 
  }else{
    header("Location: login.php?error = Error");
    exit();
} ?>