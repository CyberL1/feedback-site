<?php
require("../../inc/connect.php");
include("../../inc/header.php");
?>

<?php
session_start();
if (!isset($_SESSION['login'])) { // checks if we are logined
    header('Location: ../../../login');
    exit();
}

$login = $_SESSION['login'];

if($admincheck = mysqli_query ($connect, "SELECT * FROM `users` WHERE `admin` = '2' AND `login` = '$login'")) {
   while($isadmin = mysqli_fetch_assoc($admincheck)) {
      include("../../inc/menu-superadmin.php");
   }
}
mysqli_query($connect, "SELECT * FROM `users`");
if($admincheck = mysqli_query ($connect, "SELECT * FROM `users` WHERE `admin` = '1' AND `login`='$login'")) {
   while($isadmin = mysqli_fetch_assoc($admincheck)) {
      include("../../inc/menu-admin.php");
   }
}
if($admincheck = mysqli_query ($connect, "SELECT * FROM `users` WHERE `admin` = '0' AND `login`='$login'")) {
   while($isadmin = mysqli_fetch_assoc($admincheck)) {
    include("../../inc/menu-login.php");
   }
}
?>
<div class="container">
   <div>
      <div>
         <div>
            <div><hr>
            <h1 class="text-center">Account settings</h1>
            <p class="text-center"><b><a class="hvr-grow" href="changemail">[ CHANGE E-MAIL ]</a></b></p>
            <p class="text-center"><b><a class="hvr-grow" href="changepass">[ CHANGE PASSWORD ]</a></b></p>
            <p class="text-center"><b><a class="hvr-grow" href="delete">[ DELETE ACCOUNT ]</a></b></p>
            <p class="text-center"><b><a class="hvr-grow" href="..">[ BACK ]</a></b></p>
            </div>
			</div>
	</div>
</div>
</div>
<html>
<?php mysqli_close($connect); ?>