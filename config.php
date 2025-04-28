<?php
$servername = "localhost";
$username = "admin1";
$password = "RQu(m%e84gz8";
$dbname = "abood";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
session_start();
ob_start();
?>

