<?php
require("../../../inc/connect.php");

session_start();
$login = $_SESSION['login'];
$password = $_POST['password'];

if (!isset($_SESSION['login'])) { // checks if we are logined
    header('Location: ../../login');
    exit();
}

$query = mysqli_query($connect, "SELECT `password` FROM `users` WHERE `login` = '$login'");
if(mysqli_num_rows($query) > 0) {
    $row = mysqli_fetch_array($query);
    if(md5($password) === $row['password']) {
        mysqli_query($connect, "DELETE FROM `users` WHERE `login` = '$login'");
        mysqli_query($connect, "DELETE FROM `suggestions` WHERE `nick` = '$login'");
        mysqli_query($connect, "DELETE FROM `voters` WHERE `voter` = '$login'");
        mysqli_query($connect, "DELETE FROM `user_tickets` WHERE `nick` = '$login'");
        mysqli_query($connect, "DELETE FROM `ticket_comments` WHERE `author` = '$login'");
        unset($_SESSION['login']);
        session_destroy();
        header('Location: /');
        mysqli_close($connect);
    } else {
        echo "<div class='alert-error'><span class=\"closebtn\" onclick=\"this.parentElement.style.display='none';\">&times;</span>Password incorrect</div>";
        include("delete.php");
    }
}

?>
