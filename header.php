 <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<style>
    body{
        /* background:gray; */
    }
    .logo{
        width:50px;
    }
    .profile{
        display:flex;
        align-items: center;
    }
    .btn-outline-secondary {
      border: none;
      font-weight:bold;
      letter-spacing:0.2px;
    }
    .dropdown-toggle::after{
      display: none!important;
    }
    #profile_img{
      padding-right: 18px;
    }
    header{
      background: #a0a0a0;
      box-shadow: 0 0 5px; 
      z-index:1;
    }
</style>
<header class="p-2 mb-4 header">
      <div class="d-flex flex-wrap align-items-center justify-content-between justify-content-lg-start">

        <ul class="nav col-lg-auto me-lg-auto align-items-center justify-content-center mb-md-0">
          <li><a href="index.php" class="nav-link px-2 link-secondary">
            <img class="logo" src="assets\images\favicon.png" alt=""></a></li>
          <li><a href="index.php" class="text-light btn-outline-secondary  btn nav-link px-2">ABlood</a></li>
          <li><a href="#" class="text-light btn-outline-secondary btn nav-link px-2">Customers</a></li>
          <li><a href="#" class="text-light btn-outline-secondary btn nav-link px-2">Products</a></li>
        </ul>

        <div class="dropdown d-flex align-items-center text-end">
                <a class="btn border-0 fw-bold text-white" href="profile.php">
                  <?php
                    $email = $_SESSION['login_email'];
                    $query = "SELECT * FROM members WHERE Gmail = '$email'";
                    $result = $conn->query($query);
                    if ($result->num_rows > 0) {
                        while($row = $result->fetch_assoc()) {
                            echo $row["Name"]."&nbsp";
                       ?>
                </a>
                <a id="profile_img"  href="index.php" class="d-block link-dark text-decoration-none dropdown-toggle" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
                <img src="<?php if($row["Profile_pic"]==FALSE){echo "assets/images/avater.png";}else{ echo "assets/upload/".$row["Profile_pic"];} ?>" alt="mdo" width="32" height="32" class="rounded-circle">
                </a>
                <?php
                      }
                    } else {
                      echo "0 results";
                      }?>
          <ul class="dropdown-menu text-small" aria-labelledby="dropdownUser1">
            <li><a class="dropdown-item" href="index.php">Home</a></li>
            <li><a class="dropdown-item" href="profile.php">Profile</a></li>
            <li><a class="dropdown-item" href="edit-profile.php">Settings</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><button class="dropdown-item" data-bs-toggle="modal" data-bs-target="#logoutModal">Log out</button></li>
          </ul>
        </div>
      </div>

<!-- Logout Modal -->

<div class="modal fade" id="logoutModal" tabindex="-1" aria-labelledby="logoutModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="logoutModalLabel">Logout</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        Are you sure you want to logout?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-danger" onclick="logout()">Logout</button>
      </div>
    </div>
  </div>
</div>
      <!--Logout modal end -->

  </header>

  <script type="text/javascript">
    
    function logout() {
      $.ajax({
        type: 'POST',
        url: 'logout.php',
        success: function(response) {
          if (response === 'success') {
            window.location.href = 'login.php';
          } else {
            alert('Error: Could not logout!');
          }
        }
      });
    }
  </script>





























