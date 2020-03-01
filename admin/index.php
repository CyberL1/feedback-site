<?php
require("../inc/connect.php");
include("../inc/header.php");
?>
<?php
session_start();

$login = $_SESSION['login'];
mysqli_query($connect, "SELECT * FROM `users`");
if($admincheck = mysqli_query ($connect, "SELECT * FROM `users` WHERE `admin` = '1' AND `login`='$login'")) {
   while($isadmin = mysqli_fetch_assoc($admincheck)) {
      include("../inc/menu-admin.php");
   }
}
if($admincheck = mysqli_query ($connect, "SELECT * FROM `users` WHERE `admin` = '0' AND `login`='$login'")) {
   while($isadmin = mysqli_fetch_assoc($admincheck)) {
    header('Location: ../user/login/login.php');
    exit();
   }
}

?>
<div class="container">
   <div>
      <div>
         <div>
            <div><hr>
            <h1 class="text-center">Welcome, <?php echo $_SESSION['login'] ?></h1>
            <p class="text-center"><b><a class="hvr-grow" href="tickets/opened/opened.php">[ OPENED TICKETS ]</a></b></p>
            <p class="text-center"><b><a class="hvr-grow" href="tickets/closed/closed.php">[ CLOSED TICKETS ]</a></b></p>
            </div>
			</div>
	</div>
</div>
</div>
<html>
<?php mysqli_close($connect); ?>