<?php
require("../../../inc/connect.php");

session_start();
$login = $_SESSION['login'];
$password = $_POST['password'];

$query = mysqli_query($connect, "SELECT `password` FROM `users` WHERE `login` = '$login'");
if(mysqli_num_rows($query) > 0) {
    $row = mysqli_fetch_array($query);
    if(md5($password) === $row['password']) {
        mysqli_query($connect, "DELETE FROM `users` WHERE `login` = '$login'");
        mysqli_query($connect, "DELETE FROM `suggestions` WHERE `nick` = '$login'");
        mysqli_query($connect, "DELETE FROM `voters` WHERE `voter` = '$login'");
        unset($_SESSION['login']);
        session_destroy();
        header('Location: ../../../index.php');
    } else {
        echo "<p>Password incorrect</p>";
        include("delete.php");
    }
}

mysqli_close($connect);
?>