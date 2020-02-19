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
?>
<div class="container">
<?php include("../inc/menu-login.php"); ?>
   <div>
      <div>
         <div>
            <div><hr>
            <h1 class="text-center">Welcome, <?php echo $_SESSION['login'] ?></h1>
            <p class="text-center"><b><a class="hvr-grow" href="suggestions/new/new.php">[ NEW SUGGESTION ]</a></b></p>
            <p class="text-center"><b><a class="hvr-grow" href="suggestions/my/my.php">[ MY SUGGESTIONS ]</a></b></p>
            <p class="text-center"><b><a class="hvr-grow" href="suggestions/upvoted.php">[ UPVOTED SUGGESTIONS ]</a></b></p>
            <p class="text-center"><b><a class="hvr-grow" href="settings/settings.php">[ SETTINGS ]</a></b></p>
            <p class="text-center"><b><a class="hvr-grow" href="logout/logout.php">[ LOGOUT ]</a></b></p>
            </div>
			</div>
	</div>
</div>
</div>
<html>
<?php mysqli_close($connect); ?>