<?php
    require("config.php");
    if(isset($_SESSION['login_status']) == FALSE ){
        header("location: login.php");
        exit();
    }
?>



<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>ABood</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
        <link rel="shortcut icon" href="assets\images\favicon.png" type="image/x-icon">
        <link rel="stylesheet" href="styles.css">
        <style>
            .dropdown-toggle{
                /* display:contents !important; */
                padding: 0;
                border: 0;
                border-radius:50%;
            }
            .dropdown-toggle::after{
                display: none!important;
            }
            .form-select {
                text-align:center;
            }
            .form-select:focus {
                border-color: #86b7fe;
                outline: 0;
                box-shadow: 0 0 0 0.25rem rgb(13 110 253 / 25%);
                box-shadow: none!important;
            }
            .formBlooGroup{
                border: 1px solid transparent;
                box-shadow: 0 0 10px #383838;
            }
            .form-control {
                color: #212529;
                background-color: #fff;
                border-color: #86b7fe;
                outline: 0;
                box-shadow: 0 0 0 0.25rem rgba(13,110,253,.25);
            }
            .formm:focus {
                border-color: #86b7fe!important;
                outline: 0!important;
                box-shadow: 0 0 0 0.25rem rgb(13 110 253 / 25%)!important;
            }
            .phone.text-right {
                text-align: end;
            }
            .mr-2 {
                margin-right: 10px !important;
            }
            /* bootstrap search  */

            /* bootstrap search  */
            a{
                text-decoration: none!important;
            }
            footer.text-center.text-white{
              background-color:#bfbfbf8c!important;
            }

/*            @media only screen and (min-width: 576px){
              body {
                background-color: lightblue!important;
              }
            }*/
        </style>

    </head>
    <body style="background-image: url('assets/images/bg.png');background-repeat: no-repeat;background-attachment: fixed;">

                <!-- Bootstrap header start  -->

                <?php require("header.php");?>

                <!-- /End Bootstrap Head  -->
        <div class="container-md">
            <!-- bootstrap search -->
            <div id="formBloodGroup" class="p-2 formBlooGroup rounded bg-white form-controls">
                <form class="formm d-flex" action="" method="post">
                    <select id="selectBloodGroup" name="blood_group" class="form-select border-0" aria-label="Default select example">
                    <option value="">
                        <?php 
                        // if(!empty($_POST['blood_group'])){ echo "Blood Group ". $_POST['blood_group'];}else{ echo "Select Blood Group";}?>
                        
                            
                        </option>
                            <option value="A+">A+</option>
                            <option value="A-">A-</option>
                            <option value="B+">B+</option> 
                            <option value="B-">B-</option>
                            <option value="O+">O+</option>
                            <option value="O-">O-</option>
                            <option value="AB+">AB+</option>
                            <option value="AB-">AB-</option>
                        </select>
                        <button class="btn btn-primary" name="blood_group_btn" type="submit">Search</button>
                </form>
            </div>
            <!-- end bootstrap search -->
            <!-- <div class="search">
                <form action="" method="post"> 
                    <select name="blood_group" id="">
                        <option value=""></option>
                        <option value="A+">A+</option>
                        <option value="A-">A-</option>
                        <option value="B+">B+</option> 
                        <option value="B-">B-</option>
                        <option value="O+">O+</option>
                        <option value="O-">O-</option>
                        <option value="AB+">AB+</option>
                        <option value="AB-">AB-</option>
                    </select>
                    <button class="btn btn-primary" name="blood_group_btn" type="submit">Search</button>
                </form>
            </div> -->
            <div class="all-members">
                <?php
                if(!empty($_POST['blood_group'])){
                    $blood_group = $_POST["blood_group"];
                    $query = "SELECT * FROM members WHERE Blood_group = '$blood_group' AND Status = 'Active' ORDER BY RAND()";
                    $result = $conn->query($query);
                    echo "<h3 class='result_count'> $result->num_rows Result has found</h2>";
                    if ($result->num_rows > 0) {
                        while($row = $result->fetch_assoc()){ ?>
                            <a name="donor_profile_btn" href="donor.php?ID=<?php echo $row["ID"]; ?>">
                                    <div class="member">
                                        <div class="profile">
                                            <div class="mr-2" style="height:60px;width:60px" ><img class="rounded-circle" style="width: 100%;height: 100%;" src="<?php if($row["Profile_pic"]==FALSE){echo "assets/images/avater.png";}else{ echo "assets/upload/".$row["Profile_pic"];} ?>" alt=""></div>
                                            <div class="name&address">
                                                <h4><?php echo $row["Name"]; ?> (<?php echo $row["Blood_group"]; ?>)</h4>
                                                <p class="m-0"><?php echo $row["Address"]; ?></p>
                                            </div>
                                        </div>
                                        <div class="phone text-right">
                                            <h5><span class="d-none d-sm-inline">Last Donate : </span><?php if(empty($row['Last_donate'])){echo "Undefine";}else{ echo $row["Last_donate"];} ?></h5>
                                            <h5><span class="d-none d-sm-inline">Contract : </span><?php echo $row["Phone_number"]; ?></h5>
                                        </div>
                                    </div>
                                </a>
                            <?php
                            }
                        }
                    }else{
                        $query = "SELECT * FROM members WHERE Status = 'Active' ORDER BY RAND()";
                        $result = $conn->query($query);
                        echo "<h3 class='result_count'> $result->num_rows Result found</h2>";
                        if ($result->num_rows > 0) {
                            while($row = $result->fetch_assoc()){ ?>
                                <a href="donor.php?ID=<?php echo $row["ID"]; ?>">
                                    <div class="member">
                                        <div class="profile">
                                            <div class="mr-2" style="height:60px;width:60px" ><img class="rounded-circle" style="width: 100%;height: 100%;" src="<?php if($row["Profile_pic"]==FALSE){echo "assets/images/avater.png";}else{ echo "assets/upload/".$row["Profile_pic"];} ?>" alt=""></div>
                                            <div class="name&address">
                                                <h4><?php echo $row["Name"]; ?> (<?php echo $row["Blood_group"]; ?>)</h4>
                                                <p class="m-0"><?php echo $row["Address"]; ?></p>
                                            </div>
                                        </div>
                                        <div class="phone text-right">
                                            <h5><span class="d-none d-sm-inline">Last Donate : </span><?php if(empty($row['Last_donate']) || $row['Last_donate'] == "0000-00-00"){echo "Undefine";}else{ echo $row["Last_donate"];} ?></h5>
                                            <h5><span class="d-none d-sm-inline">Contract : </span><?php echo $row["Phone_number"]; ?></h5>
                                        </div>
                                    </div>
                                </a>
                                <?php
                                }
                            } else {
                                    echo "0 results";
                                    }
                        }
                    ?>
            </div>
        </div>
        <?php require("footer.php"); ?>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js" integrity="sha384-mQ93GR66B00ZXjt0YO5KlohRA5SY2XofN4zfuZxLkoj1gXtW8ANNCe9d5Y3eG5eD" crossorigin="anonymous"></script>
        <script type="text/javascript">
            function formControlClass(){
                document.getElementById('formBloodGroup').classList.remove('formBlooGroup');
                document.getElementById('formBloodGroup').classList.add('form-control');
            }
            function formControlClass2(){
                document.getElementById('formBloodGroup').classList.remove('form-control');
                document.getElementById('formBloodGroup').classList.add('formBlooGroup');
            }
            document.getElementById('selectBloodGroup').addEventListener('focus',formControlClass);
            document.getElementById('selectBloodGroup').addEventListener('focusout',formControlClass2);
            // selectBloodGroup formBloodGroup
        </script>
    </body>
</html>