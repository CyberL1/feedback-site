<?php
require("../../../inc/connect.php");
include("../../../inc/header.php");
?>
<?php
session_start();
if (!isset($_SESSION['login'])) { // checks if we are logined
    header('Location: ../../login');
    exit();
}

$login = $_SESSION['login'];

if($admincheck = mysqli_query ($connect, "SELECT * FROM `users` WHERE `admin` = '2' AND `login` = '$login'")) {
   while($isadmin = mysqli_fetch_assoc($admincheck)) {
      include("../../../inc/menu-superadmin.php");
   }
}

mysqli_query($connect, "SELECT * FROM `users`");
if($admincheck = mysqli_query ($connect, "SELECT * FROM `users` WHERE `admin` = '1' AND `login`='$login'")) {
   while($isadmin = mysqli_fetch_assoc($admincheck)) {
      include("../../../inc/menu-admin.php");
   }
}

if($admincheck = mysqli_query ($connect, "SELECT * FROM `users` WHERE `admin` = '0' AND `login`='$login'")) {
   while($isadmin = mysqli_fetch_assoc($admincheck)) {
    include("../../../inc/menu-login.php");
   }
}
?>
<div class="container">
   <div>
   <h1 class="text-center">Your suggestions</h1>
      <div>
         <div>
            <div>
			<hr>
               <?php
               $login = $_SESSION['login'];
                  if ($query = mysqli_query($connect, "SELECT * FROM `suggestions` WHERE `nick`='$login' ORDER BY `nr` DESC")) {
                     while ($my = mysqli_fetch_assoc ($query)) {
                       $nr = $my['nr'];
                       $login = $_SESSION['login'];
                       $nick = $my['nick'];
                       if(!$my['edited']) echo "<a href='/index.php?show=$nr'><p class='text-left'><b>".substr(strip_tags($my['title']), 0, 32)."</a></b></p><p cliass='text-right'><i>".strip_tags($my['date'])."</i> Author: <b><a href='users.php?nick=$nick'>".substr(strip_tags($my['nick']), 0, 22)."</a></b></i> | Votes: <b>".$my['votes']."</b></p><p class='text-right'>Status: <b>".$my['status']."</b> |<b> <a class='hvr-grow' href='actions?nr=$nr'>[ ACTIONS ]</a></b></p>\n<hr>";
                       if($my['edited']) echo "<a href='/index.php?show=$nr'><p class='text-left'><b>".substr(strip_tags($my['title']), 0, 32)."</a></b></p><p cliass='text-right'><i>".strip_tags($my['date'])."</i> Author: <b><a href='users.php?nick=$nick'>".substr(strip_tags($my['nick']), 0, 22)."</a></b></i> | Votes: <b>".$my['votes']."</b></p><p class='text-right'>Status: <b>".$my['status']."</b> | Edited on: <b>".$my['edit_date']."</b> | <b><a class='hvr-grow' href='actions?nr=$nr'>[ ACTIONS ]</a></b></p>\n<hr>";
                  }
               }

               mysqli_close($connect);
                  ?>
            </div>
			</div>
		</div>
	</div>
	<br>
</div>
<html>