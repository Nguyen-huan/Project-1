<?php
  include "connect.php";
  $error = "";
  if(isset($_POST["username"]) && isset($_POST["password1"]) && isset($_POST["password2"])){
    function validate($data){
      $data = trim($data);
      $data = stripcslashes($data);
      $data = htmlspecialchars($data);
      return $data;
    }
    $username = validate($_POST["username"]);
    $name = validate($_POST["name"]);
    $email = validate($_POST["email"]);
    $password1 = validate($_POST["password1"]);
    $password2 = validate($_POST["password2"]);
    if(empty($username)){
      header("Location: register.php?error=User Name is required");
      $GLOBALS['error'] = "Username Error";
      exit();
    }
    else if(empty($name)){
      header("Location: register.php?error=Name is required");
      $GLOBALS['error'] = "Password Again Error";
      exit();
    }
    else if(empty($email)){
      header("Location: register.php?error=email is required");
      $GLOBALS['error'] = "Password Again Error";
      exit();
    }
    else if(empty($password1)){
      header("Location: register.php?error=Password1 is required");
      $GLOBALS['error'] = "Password Error";
      exit();
    }
    else if(empty($password2)){
      header("Location: register.php?error=Password2 is required");
      $GLOBALS['error'] = "Password Again Error";
      exit();
    }
    
    else if($password1 !== $password2){
      header("Location: register.php?error=Input Password Again Is Not Same Input First Password");
      $GLOBALS['error'] = "Input Password Again Is Not Same Input First Password";
      exit();
    }
    else{
      $sql = "SELECT * FROM users WHERE user_name = '$username' OR email = '$email'";
      // Thực thi câu truy vấn
      $result = mysqli_query($conn, $sql);

      // Nếu kết quả trả về lớn hơn 1 thì nghĩa là username hoặc email đã tồn tại trong CSDL
      if (mysqli_num_rows($result) > 0)
      {
        header("Location: register.php?error=Username has already existed");
        $GLOBALS['error'] = "Username has already existed";
        exit();
        // Dừng chương trình
        die ();
      }
      else {
        $saltPassword = md5($password1);
        $sql = "INSERT INTO users (user_name, password, email, name, is_Admin ) VALUES ('$username','$saltPassword','$email','$name',0)";
        echo '<script language="javascript">alert("Successful!"); window.location="register.php";</script>';
        if (mysqli_query($conn, $sql)){
          header('Location: login.php');
        }
        else {
          echo '<script language="javascript">alert("Có lỗi trong quá trình xử lý"); window.location="register.php";</script>';
        }
      }
    }
  }
?>
<style>
  .error {
    width: 350px;
    color: #fbceb5 !important; margin-bottom: 20px; margin-top: -10px; margin-left: 20px;
  }
</style>
<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Register</title>
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
              <h3 class="mb-4 text-center">Have an account?</h3>
              <form action="" class="signin-form" method="POST">
              <?php
                  if(isset($_GET['error'] )&& $error = "User error"){ ?>
                    <div class="error"> 
                    <li><?php echo $_GET['error']; ?></li>
                    </div> 
                  <?php } 
                ?>
                <div class="form-group">
                  <input
                    name="username"
                    type="text"
                    class="form-control"
                    placeholder="Username"
                    
                  />
                </div>

                <div class="form-group">
                  <input
                    name="name"
                    type="text"
                    class="form-control"
                    placeholder="Name"
                    
                  />
                </div>

                <div class="form-group">
                  <input
                    name="email"
                    id="email-field"
                    type="email"
                    class="form-control"
                    placeholder="Email"
                    
                  />
                </div>

                <div class="form-group">
                  <input
                    name="password1"
                    id="password-field"
                    type="password"
                    class="form-control"
                    placeholder="Password"
                    
                  />
                  <span
                    toggle="#password-field"
                    class="fa fa-fw fa-eye field-icon toggle-password"
                  ></span>
                </div>

                <div class="form-group">
                  <input
                    name="password2"
                    id="password-field"
                    type="password"
                    class="form-control"
                    placeholder="Password Again"
                    
                  />
                  <span
                    toggle="#password-field"
                    class="fa fa-fw fa-eye field-icon toggle-password"
                  ></span>
                </div>

                <div class="form-group">
                  <button
                    type="submit"
                    class="form-control btn btn-primary submit px-3"
                  >
                    Register
                  </button>
                </div>
                <div class="form-group d-md-flex">
                  <div class="w-50">
                    <label class="checkbox-wrap checkbox-primary"
                      >Remember Me
                      <input type="checkbox" checked />
                      <span class="checkmark"></span>
                    </label>
                  </div>
                  <div class="w-50 text-md-right">
                    <a href="login.php" style="color: #fff">Login</a>
                  </div>
                </div>
              </form>
              <p class="w-100 text-center">&mdash; Or Sign In With &mdash;</p>
              
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
