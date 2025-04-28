<?php require "config.php" ;

  if(isset($_SESSION['login_status'])){
    header("location: index.php");
  }

  if(isset($_POST["register"])) {
    $name = $_POST["fullname"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];
    $address = $_POST["address"];
    $bloodgroup = $_POST["bloodgroup"];
    $password = $_POST["password"];
    $repassword = $_POST["repassword"];
                                // Profile Pic Upload
    $choosefile = $_FILES["choosefile"]["name"];
    echo $choosefile;
    $tmp_name = $_FILES["choosefile"]["tmp_name"];
    $destination = "assets/upload";
    move_uploaded_file($tmp_name,"$destination / $choosefile");

    if($password != $repassword){
      $wrong = "&nbsp &nbsp Your Password is not match";
    }else{
      $query = "INSERT INTO members (Name, Gmail, Phone_number, Address, Password, Blood_group, Profile_pic, Status) VALUES ('$name','$email','$phone','$address','$password','$bloodgroup','$choosefile','Active')";
      if(($conn->query($query)) != FALSE){
        $_SESSION['email'] = $email;
        $_SESSION['password'] = $password;
        $reg_success = "Regestration Successful";
        header("Refresh: 0.2 ; url=login.php");
      }
    }
  }
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sign Up | ABood</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.2.1/css/all.css">
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
        .pass-div{
          position: relative;
        }
        #passhide{
          position: absolute;
          width: 35px;
          top: 10px;
          right: 10px;
          cursor: pointer;
          background: white;
        }
        .wrong .fa-check{
            display: none;
        }
        .good .fa-times{
            display: none;
        }
        .wrong{
          color: red;
        }
        .good{
          color: green;
        }
        .valid-feedback,
        .invalid-feedback {
          margin-left: calc(2em + 0.25rem + 1.5rem);
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
              <h2 class="text-center mb-5">Create an account<i class="bi-alarm"></i></h2>
              <?php if(isset($reg_success)){
                echo "<div class='alert text-center alert-success' role='alert'>$reg_success</div>";
              }?>
              <form class="g-3 needs-validation" novalidate method="post" enctype="multipart/form-data" action="">

                <div class="form-outline mb-4">
                  <input type="text" name="fullname" placeholder="Full Name" id="form3Example1cg" class="form-control form-control-lg" required>
                </div>

                <div class="form-outline mb-4">
                  <input type="email" name="email" placeholder="E-mail Address" id="form3Example3fdcg" class="form-control form-control-lg" required>
                </div>

                <div class="form-outline mb-4">
                  <input type="number" name="phone" maxlength="11" placeholder="Phone Number" id="form3Exampldfe3cg" class="form-control form-control-lg" required>
                </div>

                <div class="form-outline mb-4">
                  <input type="text" name="address" placeholder="Enter Your Address" id="form3Exadfmple3cg" class="form-control form-control-lg" required>
                </div>

                <div class="form-outline mb-4">
                    <select name="bloodgroup" class="form-control-lg form-control" name="" id="" required>
                        <option value="">Select Blood Group</option>
                        <option value="A+">A+</option>
                        <option value="A-">A-</option>
                        <option value="B+">B+</option> 
                        <option value="B-">B-</option>
                        <option value="O+">O+</option>
                        <option value="O-">O-</option>
                        <option value="AB+">AB+</option>
                        <option value="AB-">AB-</option>
                    </select> 
                </div>

                <!-- <div class="pass-div form-outline mb-4"> -->
                  <!-- <input type="password" name="password" minlength="5" placeholder="Password" id="form3Example4cg" class="form-control form-control-lg" required> -->
                  <?php
                   // if (isset($wrong)) {
                   //   echo "<Font color='red'>$wrong</font>";
                   //   } 
                     ?>
                     <!-- <img class="" id="passhide" src="assets/images/pass-hide.png" onclick="passHide()" alt=""> -->
                <!-- </div> -->
                                                    <!-- password validation -->
                <div>
                  <div>
                    <div class="pass-div w-100 form-outline mb-4">
                      <input type="password" name="password" class="form-control form-control-lg" placeholder="Type your password" aria-label="password" aria-describedby="password" id="password-input" />
                      <?php if (isset($wrong)) {
                         echo "<Font color='red'>$wrong</font>";
                         } ?>
                        <img class="" id="passhide" src="assets/images/pass-hide.png" onclick="passHide()" alt="">
                    </div>
                  </div>

                  <div class="col-6 mt-2 mt-xxl-0 w-auto h-auto rounded" style="position: absolute;right: 0;">
                    <div class="alert alert-warning px-4 py-3 mb-0 d-none text-danger" role="alert" data-mdb-color="warning" id="password-alert" >
                      <ul class="list-unstyled mb-0">
                        <li class="requirements leng">
                          <i class="fas fa-check text-success me-2"></i>
                          <i class="fas fa-times text-danger me-3"></i>
                          Your password must have at least 8 chars</li>
                        <li class="requirements big-letter">
                          <i class="fas fa-check text-success me-2"></i>
                          <i class="fas fa-times text-danger me-3"></i>
                          Your password must have at least 1 big letter.</li>
                        <li class="requirements num">
                          <i class="fas fa-check text-success me-2"></i>
                          <i class="fas fa-times text-danger me-3"></i>
                          Your password must have at least 1 number.</li>
                        <li class="requirements special-char">
                          <i class="fas fa-check text-success me-2"></i>
                          <i class="fas fa-times text-danger me-3"></i>
                          Your password must have at least 1 special char.</li>
                      </ul>
                    </div>
                  </div>
                </div>
                                            <!-- end password validation -->

                <div>
                  <div class="form-outline mb-4 has-validation p-relative">
                    <input type="password" placeholder="Confrom Password" id="form3Example4cdg" class="form-control form-control-lg" required> 
                  </div>
                  <div class="col-6 mt-xxl-0 w-auto h-auto rounded" style="position: absolute;right: 50px;">
                    <div class="alert alert-warning px-3 py-2 mb-0 d-none text-danger" role="alert" data-mdb-color="warning" id="ConfirmPasswordAlert" >
                      <ul class="list-unstyled mb-0">
                        <li class="requirement leng" id="changeText">
                          <i class="fas fa-check text-success me-2"></i>
                          <i class="fas fa-times text-danger me-3"></i>
                          Confirm Password is not Match
                        </li>
                      </ul>
                    </div>
                  </div>
                </div>
                <div class="form-outline mb-4">
                  <input type="file" name="choosefile" class="form-control form-control-lg" accept="image/*" required> 
                </div>
                <div class="form-check d-flex justify-content-center mb-5">
                  <input class="form-check-input me-2" type="checkbox" value="" id="form2Example3cg" required>
                 
                    I agree all statements in <a href="#!" class="text-body"><u>Terms of service</u></a>
                </div>

                <div class="d-flex justify-content-center">
                  <button name="register" type="submit"class="btn btn-success style_need btn-block btn-lg gradient-custom-4 text-body">Register</button>
                </div>

                <p class="text-center text-muted mt-5 mb-0">Have already an account? <a href="login.php"
                    class="fw-bold text-body"><u>Login here</u></a></p>

              </form>

            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
    <script type="text/javascript" >

      // Example starter JavaScript for disabling form submissions if there are invalid fields
      (function () {
        'use strict'

        // Fetch all the forms we want to apply custom Bootstrap validation styles to
        var forms = document.querySelectorAll('.needs-validation')

        // Loop over them and prevent submission
        Array.prototype.slice.call(forms)
          .forEach(function (form) {
            form.addEventListener('submit', function (event) {
              if (!form.checkValidity()) {
                event.preventDefault()
                event.stopPropagation()
              }

              form.classList.add('was-validated')
            }, false)
          })
      })()
      // password validation script
      addEventListener("DOMContentLoaded", (event) => {
      const password = document.getElementById("password-input");
      const passwordAlert = document.getElementById("password-alert");
      const requirements = document.querySelectorAll(".requirements");
      let lengBoolean, bigLetterBoolean, numBoolean, specialCharBoolean;
      let leng = document.querySelector(".leng");
      let bigLetter = document.querySelector(".big-letter");
      let num = document.querySelector(".num");
      let specialChar = document.querySelector(".special-char");
      const specialChars = "!@#$%^&*()-_=+[{]}\\|;:'\",<.>/?`~";
      const numbers = "0123456789";

      requirements.forEach((element) => element.classList.add("wrong"));

      password.addEventListener("focus", () => {
          passwordAlert.classList.remove("d-none");
          if (!password.classList.contains("is-valid")) {
              password.classList.add("is-invalid");
          }
      });

      password.addEventListener("input", () => {
          let value = password.value;
          if (value.length < 8) {
              lengBoolean = false;
          } else if (value.length > 7) {
              lengBoolean = true;
          }

          if (value.toLowerCase() == value) {
              bigLetterBoolean = false;
          } else {
              bigLetterBoolean = true;
          }

          numBoolean = false;
          for (let i = 0; i < value.length; i++) {
              for (let j = 0; j < numbers.length; j++) {
                  if (value[i] == numbers[j]) {
                      numBoolean = true;
                  }
              }
          }

          specialCharBoolean = false;
          for (let i = 0; i < value.length; i++) {
              for (let j = 0; j < specialChars.length; j++) {
                  if (value[i] == specialChars[j]) {
                      specialCharBoolean = true;
                  }
              }
          }

          if (lengBoolean == true && bigLetterBoolean == true && numBoolean == true && specialCharBoolean == true) {
              password.classList.remove("is-invalid");
              password.classList.add("is-valid");

              requirements.forEach((element) => {
                  element.classList.remove("wrong");
                  element.classList.add("good");
              });
              passwordAlert.classList.remove("alert-warning");
              passwordAlert.classList.add("alert-success");
          } else {
              password.classList.remove("is-valid");
              password.classList.add("is-invalid");

              passwordAlert.classList.add("alert-warning");
              passwordAlert.classList.remove("alert-success");

              if (lengBoolean == false) {
                  leng.classList.add("wrong");
                  leng.classList.remove("good");
              } else {
                  leng.classList.add("good");
                  leng.classList.remove("wrong");
              }

              if (bigLetterBoolean == false) {
                  bigLetter.classList.add("wrong");
                  bigLetter.classList.remove("good");
              } else {
                  bigLetter.classList.add("good");
                  bigLetter.classList.remove("wrong");
              }

              if (numBoolean == false) {
                  num.classList.add("wrong");
                  num.classList.remove("good");
              } else {
                  num.classList.add("good");
                  num.classList.remove("wrong");
              }

              if (specialCharBoolean == false) {
                  specialChar.classList.add("wrong");
                  specialChar.classList.remove("good");
              } else {
                  specialChar.classList.add("good");
                  specialChar.classList.remove("wrong");
              }
            }
        });

        password.addEventListener("blur", () => {
            passwordAlert.classList.add("d-none");
        });
    });



                // confirm password validation start
                    // confirm password validation start
      var a = 1;
      var signupPassword = document.getElementById("password-input");
      var signupConfirmPassword = document.getElementById("form3Example4cdg");
      let leng = document.querySelector(".leng");
      const requirement = document.querySelectorAll(".requirement");
      var confirmPasswordAlert = document.getElementById("ConfirmPasswordAlert");
      var changeText = document.getElementById("changeText");
      var loginPassword = document.getElementById("form3Example4cg");
      var showHideBtn = document.getElementById("passhide");

      signupConfirmPassword.addEventListener("focus", () => {
          confirmPasswordAlert.classList.remove("d-none");
          if (!signupConfirmPassword.classList.contains("is-valid")) {
              signupConfirmPassword.classList.add("is-invalid");
          }
      });
      signupConfirmPassword.addEventListener("focusout", () => {
          confirmPasswordAlert.classList.add("d-none");
        });
      signupConfirmPassword.addEventListener("input", () => {
        let passwordValue = signupPassword.value;
        let confirmPasswordValue = signupConfirmPassword.value;
        if (passwordValue == confirmPasswordValue){
            signupConfirmPassword.classList.remove("is-invalid");
            signupConfirmPassword.classList.add("is-valid");
            confirmPasswordAlert.classList.remove("alert-warning");
            confirmPasswordAlert.classList.add("alert-success");
            changeText.innerHTML = "Confirm Password is Matched";
            requirement.forEach((element) => {
              element.classList.remove("wrong");
              element.classList.add("good");
            });
            leng.classList.add("wrong");
            leng.classList.remove("good");
        } else {
            signupConfirmPassword.classList.remove("is-valid");
            signupConfirmPassword.classList.add("is-invalid");
            requirement.forEach((element) => {
              element.classList.remove("good");
              element.classList.add("wrong");
            });
            confirmPasswordAlert.classList.remove("alert-success");
            confirmPasswordAlert.classList.add("alert-warning");
            leng.classList.add("good");
            leng.classList.remove("wrong");
        };
      });

      // End confirm password validation start
      function passHide(){
          if(a == 1){
              signupPassword.type="text";
              signupConfirmPassword.type="text";
              showHideBtn.src="assets/images/pass-show.png";
              a = 0;
          }
          else{
              signupPassword.type="password";
              signupConfirmPassword.type="password";
              showHideBtn.src="assets/images/pass-hide.png";
              a = 1;
          }
      }
      function passHideLogin(){
          if(a == 1){
              loginPassword.type="text";
              showHideBtn.src="assets/images/pass-show.png";
              a = 0;
          }
          else{
              loginPassword.type="password";
              showHideBtn.src="assets/images/pass-hide.png";
              a = 1;
          }
      }


    </script>
  </body>
</html>