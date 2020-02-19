<?php
require("../../inc/connect.php");
include("../../inc/header.php");
?>
<?php
session_start();
if (!isset($_SESSION['login'])) { // checks if we are logined
    header('Location: ../login/login.php');
    exit();
}
?>
<div class="container">
<?php include("../../inc/menu-login.php"); ?>
   <div>
      <div>
         <div>
            <div><hr>
            <h1 class="text-center">Account settings</h1>
            <p class="text-center"><b><a class="hvr-grow" href="changemail/change.php">[ CHANGE E-MAIL ]</a></b></p>
            <p class="text-center"><b><a class="hvr-grow" href="changepass/change.php">[ CHANGE PASSWORD ]</a></b></p>
            <p class="text-center"><b><a class="hvr-grow" href="delete/delete.php">[ DELETE ACCOUNT ]</a></b></p>
            <p class="text-center"><b><a class="hvr-grow" href="../">[ BACK ]</a></b></p>
            </div>
			</div>
	</div>
</div>
</div>
<html>
<?php mysqli_close($connect); ?>