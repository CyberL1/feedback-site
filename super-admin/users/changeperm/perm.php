<?php

session_start();
    
require '../../../inc/connect.php';

$login = $_POST['login'];
$perm = $_POST['perm'];

if (!isset($_SESSION['login'])) { // checks if we are logined
    header('Location: /user/login');
    exit();
}

// Protect Super-admin account from modifying
if($superadmincheck = mysqli_query ($connect, "SELECT * FROM `users` WHERE `admin` = '2' AND `login` = '$login'")) {
    while($issuperadmin = mysqli_fetch_assoc($superadmincheck)) {
        echo "<div class='alert-error'><span class=\"closebtn\" onclick=\"this.parentElement.style.display='none';\">&times;</span>Cannot change permissions for super-admin account</div>";
        include('index.php');
        exit();
    }
}

$query = mysqli_query($connect, "SELECT `admin` FROM `users` WHERE `login` = '$login'");
$login = $_POST['login'];
$subject = $_POST['subject'];
$content = $_POST['content'];
       
$query = mysqli_query($connect, "SELECT `email` FROM `users` WHERE `login` = '$login'");
$fetch = mysqli_fetch_array($query);
$email = $fetch['email'];

$content = wordwrap($content, 70, "\r\n");

if(mysqli_num_rows($query) > 0) {
    mail($email, "Your permission level has been changed", "Your permission level is now: $perm");
    $row = mysqli_fetch_array($query);
    mysqli_query($connect, "UPDATE `users` SET `admin`='$perm' WHERE `login`='$login'");
    header('Location: index.php');
} else {
    echo "<div class='alert-error'><span class=\"closebtn\" onclick=\"this.parentElement.style.display='none';\">&times;</span>Account with username $login does not exist</div>";
    include('index.php');
}

mysqli_close($connect);
?>