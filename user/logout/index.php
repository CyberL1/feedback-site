<?php
require("../../inc/connect.php");

session_start();

if(!isset($_SESSION['login'])) {
    header('Location: ../login');
    exit();
} else {
    unset($_SESSION['login']);
    session_destroy(); // make sure session is destroyed
    header('Location: ../..');
}

mysqli_close($connect);
?>