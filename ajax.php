<?php
require "config.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['email'])) {
        $email = $_POST['email'];
        $password = $_POST['password'];

        $user_email = "SELECT Gmail FROM members WHERE Gmail = '$email' AND Status = 'Active'";
        $user_email = $conn->query($user_email);

        $user_password = "SELECT Password FROM members WHERE Gmail = '$email' AND Status = 'Active'";
        $user_password = $conn->query($user_password);

        if (($user_email->num_rows > 0) && ($user_password->num_rows > 0)) {
            $user_email = $user_email->fetch_assoc();
            $user_password = $user_password->fetch_assoc();

            if (($email === $user_email['Gmail']) && ($password === $user_password['Password'])) {
                // Login successful
                $_SESSION['login_password'] = $password;
                $_SESSION['login_email'] = $email;
                $_SESSION['login_status'] = true;
                echo "success";
            } else {
                // Login failed
                echo "&nbsp &nbsp Wrong E-mail or Phone";
            }
        } else {
            // Login failed
            echo "&nbsp &nbsp Wrong E-mail or Phone";
        }        
    }
}
?>
