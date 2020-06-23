<?php
require("../../../inc/connect.php");

session_start();
$login = $_POST['login'];
$query = mysqli_query($connect, "SELECT `password` FROM `users` WHERE `login` = '$login'");
if (!isset($_SESSION['login'])) { // checks if we are logined
    header('Location: /user/login/login.php');
    exit();
}

// Protect Super-admin account from modifying
if($superadmincheck = mysqli_query ($connect, "SELECT * FROM `users` WHERE `admin` = '2' AND `login` = '$login'")) {
    while($issuperadmin = mysqli_fetch_assoc($superadmincheck)) {
        echo "<div class='alert-error'><span class=\"closebtn\" onclick=\"this.parentElement.style.display='none';\">&times;</span>Cannot delete super-admin account</div>";
        include("index.php");
        exit();
    }
}

$query = mysqli_query($connect, "SELECT `email` FROM `users` WHERE `login` = '$login'");
$fetch = mysqli_fetch_array($query);
$email = $fetch['email'];
   
$content = wordwrap($content, 70, "\r\n");

if(mysqli_num_rows($query) > 0) {
    mail($email, "Account deletetion", "Your account $login has beed deleted due to TOS Violation");
       
    $row = mysqli_fetch_array($query);
    mysqli_query($connect, "DELETE FROM `users` WHERE `login` = '$login'");
    mysqli_query($connect, "DELETE FROM `suggestions` WHERE `nick` = '$login'");
    mysqli_query($connect, "DELETE FROM `voters` WHERE `voter` = '$login'");
    mysqli_query($connect, "DELETE FROM `user_tickets` WHERE `nick` = '$login'");
    mysqli_query($connect, "DELETE FROM `ticket_comments` WHERE `author` = '$login'");
    mysqli_close($connect);
    echo "<div class='alert-succecss'><span class=\"closebtn\" onclick=\"this.parentElement.style.display='none';\">&times;</span>Account $login deleted</div>";
    include("index.php");
} else {
    echo "<div class='alert-error'><span class=\"closebtn\" onclick=\"this.parentElement.style.display='none';\">&times;</span>Username incorrect</div>";
    include("index.php");
}
?>