<?php
require("../inc/connect.php");
include("../inc/header.php");
?>
<?php
session_start();
if (!isset($_SESSION['login'])) { // checks if we are logined
    header('Location: login/login.php');
    exit();
}
$login = $_SESSION['login'];
mysqli_query($connect, "SELECT * FROM `users`");
if($admincheck = mysqli_query ($connect, "SELECT * FROM `users` WHERE `admin` = '1' AND `login`='$login'")) {
   while($isadmin = mysqli_fetch_assoc($admincheck)) {
      include("../inc/menu-admin.php");
   }
}
if($admincheck = mysqli_query ($connect, "SELECT * FROM `users` WHERE `admin` = '0' AND `login`='$login'")) {
   while($isadmin = mysqli_fetch_assoc($admincheck)) {
    include("../inc/menu-login.php");
   }
}
?>
<div class="container">
   <div>
      <div>
         <div>
            <div><hr>
            <h1 class="text-center">Welcome, <?php echo $_SESSION['login'] ?></h1>
            <p class="text-center"><b><a class="hvr-grow" href="suggestions/new/new.php">[ NEW SUGGESTION ]</a></b></p>
            <p class="text-center"><b><a class="hvr-grow" href="suggestions/my/my.php">[ MY SUGGESTIONS ]</a></b></p>
            <p class="text-center"><b><a class="hvr-grow" href="suggestions/upvoted.php">[ UPVOTED SUGGESTIONS ]</a></b></p>
            <p class="text-center"><b><a class="hvr-grow" href="tickets/open/open.php">[ OPEN TICKET ]</a></b></p>
            <p class="text-center"><b><a class="hvr-grow" href="tickets/my/my.php">[ MY TICKETS ]</a></b></p>
            <p class="text-center"><b><a class="hvr-grow" href="settings/settings.php">[ SETTINGS ]</a></b></p>
            <p class="text-center"><b><a class="hvr-grow" href="logout/logout.php">[ LOGOUT ]</a></b></p>
            </div>
			</div>
	</div>
</div>
</div>
<html>
<?php mysqli_close($connect); ?>