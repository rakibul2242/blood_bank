<?php 
  require("config.php");
  if(isset($_SESSION['login_status']) == FALSE ){
    header("location: login.php");
    exit();
  }
  //  $query = "SELECT * FROM members WHERE Gmail = '$email'";
  //  $result = $conn->query($query);
  //  if ($result->num_rows > 0) {
  //      while($row = $result->fetch_assoc()) {
  //      }}
  $email = $_SESSION['login_email'];
  $query = "SELECT * FROM members WHERE Gmail = '$email'";
  $result = $conn->query($query);
  if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
      if(isset($_POST['Update_btn'])){
        $Name = $_POST['Name'];
        $Gmail = $_POST['Gmail'];
        $Phone_number = $_POST['Phone_number'];
        $Address = $_POST['Address'];
        $Blood_group = $_POST['Blood_group'];
        if(empty($_FILES['Profile_pic']['name'])){
          $Profile_pic = $row['Profile_pic'];
        }else{
          $Profile_pic = $_FILES["Profile_pic"]["name"];
          $tmp_name = $_FILES["Profile_pic"]["tmp_name"];
          $desti = "assets/upload";
          move_uploaded_file($tmp_name,"$desti/$Profile_pic");
        }
        $Last_donate = $_POST['Last_donate'];
        $Donor_title = $_POST['Donor_title'];
        if(empty($_POST['Facebook'])){$Facebook = "username";}else{$Facebook = strtolower($_POST['Facebook']);}
        if(empty($_POST['Instagram'])){$Instagram = "username";}else{$Instagram = strtolower($_POST['Instagram']);}
        if(empty($_POST['Twitter'])){$Twitter = "username";}else{$Twitter = strtolower($_POST['Twitter']);}
        if(empty($_POST['YouTube'])){$YouTube = "channelname";}else{$YouTube = strtolower($_POST['YouTube']);}

        $email = $_SESSION['login_email'];
        $update_query = "UPDATE  members  SET Name ='$Name', Gmail ='$Gmail', Phone_number ='$Phone_number', Address ='$Address', Blood_group ='$Blood_group', Profile_pic ='$Profile_pic', Last_donate ='$Last_donate', Donor_title ='$Donor_title', Facebook ='$Facebook', Instagram ='$Instagram', Twitter ='$Twitter', YouTube ='$YouTube' WHERE Gmail ='$email'";
        // header("edit-profile.php");
        // header("profile.php");
        if($conn->query($update_query)==TRUE){
          $update_alart =  "<div class='text-center text-dark alert alert-success' role='alert'>
          Profile updated successfully </div>";
          header("Refresh:1; url=profile.php");
        }else{
          $not_update_alart = "<div class='alert alert-danger' role='alert'>
          Profile not updated </div>";}
  }}}

?>
<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Profile Update | ABlood</title><link rel="shortcut icon" href="assets\images\favicon.png" type="image/x-icon">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
        <style>
            body{
                margin-top:20px;
                color: #1a202c;
                text-align: left;
                background-color: #e2e8f0!important;    
            }
            .header{
              background:cadetblue;
              /* border:2px solid red!important; */
              /* padding-top:0!important;
              padding-bottom:0!important; */
            }
            .main-body {
                padding: 15px;
            }
            .card {
                box-shadow: 0 1px 3px 0 rgba(0,0,0,.1), 0 1px 2px 0 rgba(0,0,0,.06);
            }

            .card {
                position: relative;
                display: flex;
                flex-direction: column;
                min-width: 0;
                word-wrap: break-word;
                background-color: #fff;
                background-clip: border-box;
                border: 0 solid rgba(0,0,0,.125);
                border-radius: .25rem;
            }

            .card-body {
                flex: 1 1 auto;
                min-height: 1px;
                padding: 1rem;
            }

            .gutters-sm {
                margin-right: -8px;
                margin-left: -8px;
            }

            .gutters-sm>.col, .gutters-sm>[class*=col-] {
                padding-right: 8px;
                padding-left: 8px;
            }
            .mb-3, .my-3 {
                margin-bottom: 1rem!important;
            }

            .bg-gray-300 {
                background-color: #e2e8f0;
            }
            .h-100 {
                height: 100%!important;
            }
            .shadow-none {
                box-shadow: none!important;
            }
            footer.text-center.text-white{
                background-color:#80808063!important;
            }
            input::-webkit-outer-spin-button,
            input::-webkit-inner-spin-button {
                -webkit-appearance: none;
                margin: 0;
            }
            input:focus-visible {
                outline: 2px solid #2196f3!important;
                border-radius: 3px!important;
                border: 2px solid transparent!important;
            }
            .focusvisite:focus-visible{
                outline: 2px solid #2196f3!important;
                border-radius: 3px!important;
            }
            img#blah{
              /* width:50px !important;
              height:50px; */
              width:100%;
              height:100%;
            }
            label.cursor-pointer {
              position: absolute;
              background: #40404000;
              cursor: pointer;
              width: 100%;
              color: white;
              display: flex;
              border-top: 55px solid #00000000;
              box-sizing: content-box;
              font-size: 12px;
              bottom: 0;
              height: 13px;
              justify-content: center;
            }
            .preview_img{
              background: gray;
              width: 50px;
              cursor: pointer;
              height: 50px;
              overflow: hidden;
              border-radius: 50%;
              position: relative;
            }
            i.fa-solid.fa-camera {
              background: #04040499;
              padding: 0px 20px;
            }
            
        </style>
    </head>
    <body>
    <?php 
  require("header.php");


?> 
    <div class="container">
    <div class="main-body">
    
          <!-- Breadcrumb 
          <nav aria-label="breadcrumb" class="main-breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="index.html">Home</a></li>
              <li class="breadcrumb-item"><a href="javascript:void(0)">User</a></li>
              <li class="breadcrumb-item active" aria-current="page">User Profile</li>
            </ol>
          </nav>
             /Breadcrumb -->
            <?php if(isset($update_alart)){echo $update_alart;}elseif(isset($not_update_alart)){echo $not_update_alart;}?>
          <div class="row gutters-sm">
            <div class="col-md-4 mb-3">
              <div class="card">
                <div class="card-body">
                  <div class="d-flex flex-column align-items-center text-center">
                  <?php
                    $email = $_SESSION['login_email'];
                    $query = "SELECT * FROM members WHERE Gmail = '$email'";
                    $result = $conn->query($query);
                    if ($result->num_rows > 0) {
                        while($row = $result->fetch_assoc()) {
                       ?>
                       <!-- Start show data from BD -->
                </h6></a>
                <a href="index.php" class="d-block link-dark text-decoration-none dropdown-toggle" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
                </a>
                <!-- Start show data from BD -->

                    <!-- Priview Image -->
                     <!-- <div runat="server">
                       <label for="imgInp">Select</label>
                       <input accept="image/*" type='file' class="d-none" id="imgInp" />
                       <img id="blah" class="rounded-circle"  src="<?php echo "assets/upload/". $row['Profile_pic'];?>" alt="Image" />
                     </div> -->
                    <!-- Priview Image  -->
                
                    <div class="mr-2" style="height:200px;width:200px" ><img class="rounded-circle" style="width: 100%;height: 100%;" src="<?php if($row["Profile_pic"]==FALSE){echo "assets/images/avater.png";}else{ echo "assets/upload/".$row["Profile_pic"];} ?>" alt=""></div>
                    <div class="mt-3">
                      
                      <h4><?php echo $row['Name'];?></h4>
                      <p class="text-secondary mb-1"><?php echo $row['Donor_title'];?></p>
                      <p class="text-muted font-size-sm"><?php echo $row['Address'];?></p>
                      <a <?php if($row['Facebook'] != 'username'){ echo 'href="https://www.facebook.com/'.$row['Facebook'].'"';} ?> class="btn btn-outline-primary" target="_blank">Follow</a>
                      <a <?php if($row['Facebook'] != 'username'){ echo 'href="https://www.messenger.com/t/'.$row['Facebook'].'"';} ?> class="btn btn-outline-primary" target="_blank">Message</a>
                    </div>
                  </div>
                </div>
              </div>
                          <!-- Start Form - Database edit -->
              <form action="" method="post" enctype="multipart/form-data">
              <div class="card mt-3">
                <ul class="list-group list-group-flush">
                  <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                    <h6 class="mb-0"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-facebook mr-2 icon-inline text-primary"><path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"></path></svg>Facebook.com/</h6>
                    <span class="w-50 text-secondary"><input name="Facebook" class="w-100 text-end" type="text" placeholder="username" value="<?php if(($row['Facebook'])!="username"){echo $row['Facebook'];}?>"></span>
                  </li>
                  <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                    <h6 class="mb-0"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-instagram mr-2 icon-inline text-danger"><rect x="2" y="2" width="20" height="20" rx="5" ry="5"></rect><path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"></path><line x1="17.5" y1="6.5" x2="17.51" y2="6.5"></line></svg>Instagram.com/</h6>
                    <span class="w-50 text-secondary"><input name="Instagram" class="w-100 text-end" type="text" placeholder="username" value="<?php if(($row['Instagram'])!="username"){echo $row['Instagram'];}?>"></span>
                  </li>
                  <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                    <h6 class="mb-0"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-twitter mr-2 icon-inline text-info"><path d="M23 3a10.9 10.9 0 0 1-3.14 1.53 4.48 4.48 0 0 0-7.86 3v1A10.66 10.66 0 0 1 3 4s-4 9 5 13a11.64 11.64 0 0 1-7 2c9 5 20 0 20-11.5a4.5 4.5 0 0 0-.08-.83A7.72 7.72 0 0 0 23 3z"></path></svg>Twitter.com/</h6>
                    <span class="w-50 text-secondary"><input name="Twitter" class="w-100 text-end" type="text" placeholder="username" value="<?php if(($row['Twitter'])!="username"){echo $row['Twitter'];}?>"></span>
                  </li>
                  <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                    <h6 class="mb-0"><svg style="color: red" xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-youtube" viewBox="0 0 16 16"> <path d="M8.051 1.999h.089c.822.003 4.987.033 6.11.335a2.01 2.01 0 0 1 1.415 1.42c.101.38.172.883.22 1.402l.01.104.022.26.008.104c.065.914.073 1.77.074 1.957v.075c-.001.194-.01 1.108-.082 2.06l-.008.105-.009.104c-.05.572-.124 1.14-.235 1.558a2.007 2.007 0 0 1-1.415 1.42c-1.16.312-5.569.334-6.18.335h-.142c-.309 0-1.587-.006-2.927-.052l-.17-.006-.087-.004-.171-.007-.171-.007c-1.11-.049-2.167-.128-2.654-.26a2.007 2.007 0 0 1-1.415-1.419c-.111-.417-.185-.986-.235-1.558L.09 9.82l-.008-.104A31.4 31.4 0 0 1 0 7.68v-.123c.002-.215.01-.958.064-1.778l.007-.103.003-.052.008-.104.022-.26.01-.104c.048-.519.119-1.023.22-1.402a2.007 2.007 0 0 1 1.415-1.42c.487-.13 1.544-.21 2.654-.26l.17-.007.172-.006.086-.003.171-.007A99.788 99.788 0 0 1 7.858 2h.193zM6.4 5.209v4.818l4.157-2.408L6.4 5.209z" fill="red"></path> </svg>Youtube.com/</h6>
                    <span class="w-50 text-secondary"><input name="YouTube" class="w-100 text-end" type="text" placeholder="channelname" value="<?php if(($row['YouTube'])!="channelname"){echo $row['YouTube'];}?>"></span>
                  </li>
                </ul>
              </div>
            </div>
            <div class="col-md-8">
              <div class="card mb-3">
                <div class="card-body">
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Full Name</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                        <input name="Name" class="w-50" placeholder="Ful Name" type="text" value="<?php echo $row['Name'];?>" required>
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Title</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                    <input name="Donor_title" class="w-50" placeholder="Title - Ex. Blood Fignter" type="text" value="<?php echo $row['Donor_title'];?>" required>
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Email</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                    <input name="Gmail" class="w-50 user-select-all" placeholder="E-mail Address" type="email" value="<?php echo $row['Gmail'];?>" required>
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Mobile</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                    <input name="Phone_number" class="w-50 user-select-all" placeholder="Mobile Number" max-length="11" type="number" value="<?php echo $row['Phone_number'];?>" required>
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Address</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                    <input name="Address" class="w-50" placeholder="Present Address" type="text" value="<?php echo $row['Address'];?>" required>
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Blood Group</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                                                            <!-- Need Php start   -->
                        <!-- if($row['Blood_group'] == "O-"){echo "O Negative";}elseif($row['Blood_group'] == "O+"){echo "O Positive";} -->
                         <!-- elseif($row['Blood_group'] == "AB-"){echo "AB Negative";}elseif($row['Blood_group'] == "AB+"){echo "AB Positive";} -->
                         <!-- elseif($row['Blood_group'] == "B-"){echo "B Negative";}elseif($row['Blood_group'] == "B+"){echo "B Positive";} -->
                         <!-- elseif($row['Blood_group'] == "A-"){echo "A Negative";}elseif($row['Blood_group'] == "A+"){echo "A Positive";} -->
                                                            <!-- Need Php start   -->
                    <!-- Bootstrap Dropdown -->
                    <div class="dropdown">
                        <Select name="Blood_group" class="focusvisite btn text-dark bg-light dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false" required>
                            <ul class="dropdown-menu">
                                <option value="A+" class="dropdown-item bg-light text-center text-dark user-select-none cursor-pointer" <?php if($row['Blood_group'] == "A+"){echo "Selected";} ?>> A+ </option>
                                <option value="A-" class="dropdown-item bg-light text-center text-dark user-select-none cursor-pointer" <?php if($row['Blood_group'] == "A-"){echo "Selected";} ?>> A- </option>
                                <option value="B+" class="dropdown-item bg-light text-center text-dark user-select-none cursor-pointer" <?php if($row['Blood_group'] == "B+"){echo "Selected";} ?>> B+ </option>
                                <option value="B-" class="dropdown-item bg-light text-center text-dark user-select-none cursor-pointer" <?php if($row['Blood_group'] == "B-"){echo "Selected";} ?>> B- </option>
                                <option value="AB+" class="dropdown-item bg-light text-center text-dark user-select-none cursor-pointer" <?php if($row['Blood_group'] == "AB+"){echo "Selected";} ?>> AB+ </option>
                                <option value="AB-" class="dropdown-item bg-light text-center text-dark user-select-none cursor-pointer" <?php if($row['Blood_group'] == "AB-"){echo "Selected";} ?>> AB- </option>
                                <option value="O+" class="dropdown-item bg-light text-center text-dark user-select-none cursor-pointer" <?php if($row['Blood_group'] == "O+"){echo "Selected";} ?>> O+ </option>
                                <option value="O-" class="dropdown-item bg-light text-center text-dark user-select-none cursor-pointer" <?php if($row['Blood_group'] == "O-"){echo "Selected";} ?>> O- </option>
                            </ul>
                        </Select>
                    </div>
                   <!-- Bootstrap Dropdown  -->
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Last Donate</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                    <input name="Last_donate" type="date" style="cursor:pointer;" value="<?php if(!empty($row['Last_donate'])){echo $row['Last_donate'];}else{echo "";}?>" max="<?php date_default_timezone_set("Asia/Dhaka"); echo date("Y-m-d");?>">
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3 d-flex">
                      <h6 class="d-flex justify-centent-center align-items-center mb-0">Profile Image</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                     <!-- Priview Image -->
                     <div class="update_img">
                      <div class="preview_img" runat="server">
                        <label id="label" for="imgInp" class="cursor-pointer"><i class="fa-solid fa-camera"></i></label>
                        <input name="Profile_pic" accept="image/*" type='file' class="d-none" id="imgInp" />
                        <img id="blah" class="rounded-circle"  src="<?php if($row["Profile_pic"]==FALSE){echo "assets/images/avater.png";}else{ echo "assets/upload/".$row["Profile_pic"];} ?>" alt="Image" />
                      </div>
                     </div>
                    <!-- Priview Image  -->

                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-12">
                      <input name="Update_btn" type="submit" value="Update Profile" class="btn btn-primary " target="_top" href="edit-profile.php">
                    </div>
                  </div>
                </div>
              </div>
              <?php
                      }
                    } else {
                      echo "0 results";
                      }?>
              </div>
            </form>
                    <!-- End Form - Database edit -->
          </div>
        </div>
    </div>
    <?php 
  require("footer.php");

  ?>  
  <script>
    imgInp.onchange = evt => {
  const [file] = imgInp.files
  if (file) {
    blah.src = URL.createObjectURL(file)
  }
}
// document.getElementById("blah").addEventListener("mouseover", function(){
//   // document.getElementById("label").style.height = "60px";
//   // document.getElementById("label").style.width = "60px";
//   document.getElementById("label").style.zIndex: "1";
//   // document.getElementById("label").style.transform: "scaleY(1)";
// })
// document.getElementById("blah").addEventListener("mouseout", function(){
//   document.getElementById("label").style.height = "0px";
//   document.getElementById("label").style.width = "0px";
//   // document.getElementById("label").style.transform: "scaleY(0)";
// })

  </script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js" integrity="sha384-mQ93GR66B00ZXjt0YO5KlohRA5SY2XofN4zfuZxLkoj1gXtW8ANNCe9d5Y3eG5eD" crossorigin="anonymous"></script>
  </body>
</html>