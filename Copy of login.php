<?php require "config.php";

if(isset($_SESSION['login_status'])){
  header("location: index.php");
  exit();
}

if(isset($_POST['submit'])){
    $email = $_POST['email'];
    $password = $_POST['password'];
    $user_email = "SELECT Gmail FROM members WHERE Gmail = '$email'";
    $user_email = $conn->query($user_email);
    $user_password = "SELECT Password FROM members WHERE Gmail = '$email'";
    $user_password = $conn->query($user_password);
    if(($user_email->num_rows > 0) && ($user_password->num_rows > 0)){
        $user_email = $user_email->fetch_assoc();
        $user_password = $user_password->fetch_assoc();
        if(($email === $user_email['Gmail']) && ($password === $user_password['Password'])){
            $result = "login successful";
            $_SESSION['login_password'] = $password;
            $_SESSION['login_email'] = $email;
            $_SESSION['login_status'] = TRUE;
            header("Refresh: 0.2; url=index.php");
        } else {
            $wrong = "<Font color='red'>&nbsp &nbsp Wrong E-mail or Phone </font>";
        }
    } elseif(empty($email) || empty($password)) {
      $wrong = "<Font color='red'>&nbsp &nbsp Login Failed </font>";
    }else {
      $wrong = "<Font color='red'>&nbsp &nbsp E-mail or Phone is wrong </font>";
    }
}?>


<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Log in | ABlood</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="shortcut icon" href="assets\images\favicon.png" type="image/x-icon">
    <link rel="stylesheet" href="signup.css">
    <style>
        .col-lg-7 {
            flex: 0 0 auto;
            width: 50%;
        }
        .form-control-lg {
            min-height: calc(1.5em + 1rem + calc(var(--bs-border-width) * 2));
            padding: 0.5rem 1rem;
            font-size: 1rem;
            border-radius: 0.5rem;
        }
        .mb-4 {
            margin-bottom: 1rem!important;
        }
        .gradient-custom-4{
            background: #84fab0;
            background: -webkit-linear-gradient(to right, rgba(132, 250, 176, 1), rgba(143, 211, 244, 1));
            background: linear-gradient(to right, rgba(132, 250, 176, 1), rgba(143, 211, 244, 1))
        }
        .mt-5 {
            margin-top: 1rem!important;
        }
        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }
        section{
            background: url(assets\images\bg.png);
            background-repeat: no-repeat;
            background-position: center;
            background: cadetblue;
            background-attachment: fixed;
            background-size: cover;
        }
        .pass-div{
          position: relative;
        }
        #passhide{
          position: absolute;
          width: 35px;
          top: 10px;
          right: 10px;
          cursor: pointer;
        }
    </style>
  </head>
  <body>
  <section class="vh-100 bg-image"
  style="background-image: url('assets/images/bg.png');">
  <div class="mask d-flex align-items-center h-100 gradient-custom-3">
    <div class="container h-100">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-12 col-md-9 col-lg-7 col-xl-6">
          <div class="card" style="border-radius: 15px;">
            <div class="card-body p-5">
              <h2 class="text-center mb-5">Create an account</h2>
              <?php if(isset($result)){echo "<div class='alert text-center alert-success'>$result</div>";}?>
              <form id="loginForm" method="post" action="">
                <div class="form-outline mb-4">
                  <input id="inputEmail"> type="text" name="email" value="<?php if(isset($email)){echo $email;} elseif(isset($_SESSION['email'])){echo $_SESSION['email'];} ?>" placeholder="E-mail or Phone" id="form3Example1cg" class="form-control form-control-lg" />
                </div>
                
                <div class="pass-div form-outline mb-4">
                  <input id="inputEmail" type="password" name="password" value="<?php if(isset($_SESSION['password'])){echo $_SESSION['password'];} ?>" placeholder="Password" id="form3Example4cg" class="form-control form-control-lg" />
                  <img class="" id="passhide" src="assets/images/pass-hide.png" onclick="passHideLogin()" alt="">
                </span>
                </div>
                <?php if(isset($wrong)){echo $wrong;} ?>

                <div class="mt-4 d-flex justify-content-center">
                  <button type="submit" name="submit" class="btn btn-success style_need btn-block btn-lg gradient-custom-4 text-body">Log In</button>
                </div>

                <p class="text-center text-muted mt-5 mb-0">Create a account <a href="signup.php"
                    class="fw-bold text-body"><u>Register here</u></a></p>

              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <script src="main.js" ></script>
  </body>
</html>