<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        session_unset();
        session_destroy();
        echo "success";
        header("location: index.php");
    }else {
    header("location: index.php");
}
?>
