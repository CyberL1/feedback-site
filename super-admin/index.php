<?php
require("../inc/connect.php");
include("../inc/header.php");
?>
<?php
session_start();

$login = $_SESSION['login'];

if (!isset($_SESSION['login'])) { // checks if we are logined
   header('Location: /user/login/login.php');
   exit();
}

if($admincheck = mysqli_query ($connect, "SELECT * FROM `users` WHERE `admin` = '2' AND `login` = '$login'")) {
   while($isadmin = mysqli_fetch_assoc($admincheck)) {
      include("../inc/menu-superadmin.php");
   }
}

if($admincheck = mysqli_query ($connect, "SELECT * FROM `users` WHERE `admin` != '2' AND `login` = '$login'")) {
   while($isadmin = mysqli_fetch_assoc($admincheck)) {
      header('Location: ../user/login');
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
            <p class="text-center"><b><a class="hvr-grow" href="/admin/tickets/opened">[ OPENED TICKETS ]</a></b></p>
            <p class="text-center"><b><a class="hvr-grow" href="/admin/tickets/closed">[ CLOSED TICKETS ]</a></b></p>
            <p class="text-center"><b><a class="hvr-grow" href="users">[ MANAGE USERS ]</a></b></p>
            </div>
			</div>
	</div>
</div>
</div>
<html>
<?php mysqli_close($connect); ?>
