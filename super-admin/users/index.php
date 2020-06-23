<?php
require("../../inc/connect.php");
include("../../inc/header.php");
?>

<?php
session_start();

if (!isset($_SESSION['login'])) { // checks if we are logined
   header('Location: /user/login/login.php');
   exit();
}

$login = $_SESSION['login'];

if($admincheck = mysqli_query ($connect, "SELECT * FROM `users` WHERE `admin` != '2' AND `login` = '$login'")) {
   while($isadmin = mysqli_fetch_assoc($admincheck)) {
      header('Location: ../user/login');
      exit();
   }
}

if($admincheck = mysqli_query ($connect, "SELECT * FROM `users` WHERE `admin` = '2' AND `login`='$login'")) {
   while($isadmin = mysqli_fetch_assoc($admincheck)) {
      include("../../inc/menu-superadmin.php");
   }
}

?>
<div class="container">
   <div>
      <div>
         <div>
            <div><hr>
            <h1 class="text-center">Manage users</h1>
            <p class="text-center"><b><a class="hvr-grow" href="/admin/users/changemail">[ CHANGE E-MAIL ]</a></b></p>
            <p class="text-center"><b><a class="hvr-grow" href="/admin/users/changepass">[ CHANGE PASSWORD ]</a></b></p>
            <p class="text-center"><b><a class="hvr-grow" href="changeperm">[ CHANGE PERM ]</a></b></p>
            <p class="text-center"><b><a class="hvr-grow" href="/admin/users/sendmail">[ SEND MAIL ]</a></b></p>
            <p class="text-center"><b><a class="hvr-grow" href="/admin/users/delete">[ DELETE ACCOUNT ]</a></b></p>
            <p class="text-center"><b><a class="hvr-grow" href="..">[ BACK ]</a></b></p>
            </div>
			</div>
	</div>
</div>
</div>
<html>
<?php mysqli_close($connect); ?>