<?php 
  require_once './header.php' ;
  session_start();
  require_once "./connect.php";
  $error = "";
  if(isset($_POST["username"]) && isset($_POST["password"])){
    function validate($data){
      $data = trim($data);
      $data = stripcslashes($data);
      $data = htmlspecialchars($data);
      return $data;
    }
    $username = validate($_POST["username"]);
    $password = validate($_POST["password"]);
    if(empty($username)){
      header("Location: login.php?error=User Name is required");
      $GLOBALS['error'] = "Username Error";
      exit();
    }
    else if(empty($password)){
      header("Location: login.php?error=Password is required");
      $GLOBALS['error'] = "Password Error";
      exit();
    }
    else{
      $saltPassword = md5($password);
      $sql = "SELECT * FROM users WHERE user_name = '$username' AND password = '$saltPassword'";
      $result = mysqli_query($conn, $sql);
      if(mysqli_num_rows($result)===1){
        $row = mysqli_fetch_assoc($result);
        if($row["user_name"]=== $username && $row['password']=== $saltPassword){
          $_SESSION['id'] = $row['id'];
          $_SESSION['user_name'] = $row['user_name'];
          $_SESSION['password'] = $row['password'];
          $_SESSION['name'] = $row['name'];
          $_SESSION['admin'] = $row['is_Admin'];
          // var_dump($row['is_Admin']);
          if($row['is_Admin']==1){
            header("Location: CRUD_employee/employeeList.php");
          }
          else{
            header("Location: home.php");
          }
          // var_dump($_SESSION);
        }
      }
      else{
        header("Location: login.php?error=Incorect Username or Password");
        exit();
      }
    }
    mysqli_close($conn);
  }
?>

<h1 class="display-3 text-center mt-5 mb-5">Login</h1>
<div class="container w-25 bg-white p-4">
  <form action="" method="POST">
    <p class="text-center">Sign in to start your session</p>
    <div class="input-group col-12 mb-3">
      <input type="text" class="form-control" name="username" id="username" placeholder="Username">
      <div class="input-group-append">
        <div class="input-group-text">
          <span class="fas fa-envelope"></span>
        </div>
      </div>
    </div>
    <div class="input-group col-12 mb-3">
      <input type="password" class="form-control" name="password" id="password" placeholder="Password">
      <div class="input-group-append">
        <div class="input-group-text">
          <span class="fas fa-lock"></span>
        </div>
      </div>
    </div>
    <div class="row justify-content-between">
      <div class="icheck-success ml-2 col-5">
        <input type="checkbox" id="remember">
        <label for="remember">
          Remember Me
        </label>
      </div>
      <div class="col-3 d-flex justify-content-end">
        <input type="submit" class=" btn btn-outline-success w-100 pl-2 pr-2">
      </div>
    </div>
    <p class="text-center mt-2">-Or-</p>
    <a href="" class="btn btn-block btn-primary">
      <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
        class="bi bi-facebook mr-2 mb-1" viewBox="0 0 16 16">
        <path
          d="M16 8.049c0-4.446-3.582-8.05-8-8.05C3.58 0-.002 3.603-.002 8.05c0 4.017 2.926 7.347 6.75 7.951v-5.625h-2.03V8.05H6.75V6.275c0-2.017 1.195-3.131 3.022-3.131.876 0 1.791.157 1.791.157v1.98h-1.009c-.993 0-1.303.621-1.303 1.258v1.51h2.218l-.354 2.326H9.25V16c3.824-.604 6.75-3.934 6.75-7.951z" />
      </svg>Sign in using Facebook</a>

    <a href="" class="btn btn-block btn-danger">
      <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-google mr-2 mb-1"
        viewBox="0 0 16 16">
        <path
          d="M15.545 6.558a9.42 9.42 0 0 1 .139 1.626c0 2.434-.87 4.492-2.384 5.885h.002C11.978 15.292 10.158 16 8 16A8 8 0 1 1 8 0a7.689 7.689 0 0 1 5.352 2.082l-2.284 2.284A4.347 4.347 0 0 0 8 3.166c-2.087 0-3.86 1.408-4.492 3.304a4.792 4.792 0 0 0 0 3.063h.003c.635 1.893 2.405 3.301 4.492 3.301 1.078 0 2.004-.276 2.722-.764h-.003a3.702 3.702 0 0 0 1.599-2.431H8v-3.08h7.545z" />
      </svg>Sign in using Google</a>
    <div class="row mt-3 justify-content-around">
      <a class="btn btn-link text-success" href="#">Forgot Password?</a>
      <a class="btn btn-link text-success" href="#">Register?</a>
    </div>
</div>
</form>
</div>

<?php
require_once './footer.php'
?>