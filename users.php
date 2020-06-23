<?php
include("inc/header.php");
require("inc/connect.php");

session_start();

if (!isset($_SESSION['login'])) { // checks if we are logined
    include("inc/menu.php");
} else {
   $login = $_SESSION['login'];

   if($admincheck = mysqli_query ($connect, "SELECT * FROM `users` WHERE `admin` = '2' AND `login` = '$login'")) {
      while($isadmin = mysqli_fetch_assoc($admincheck)) {
         include("inc/menu-superadmin.php");
      }
   }

   if($admincheck = mysqli_query ($connect, "SELECT * FROM `users` WHERE `admin` = '1' AND `login`='$login'")) {
       while($isadmin = mysqli_fetch_assoc($admincheck)) {
          include("inc/menu-admin.php");
         }
      }
      if($admincheck = mysqli_query ($connect, "SELECT * FROM `users` WHERE `admin` = '0' AND `login`='$login'")) {
         while($isadmin = mysqli_fetch_assoc($admincheck)) {
            include("inc/menu-login.php");
         }
         }
   }
if(isset($_GET['nick'])) {
    $nick = $_GET['nick'];

if ($querynick = mysqli_query ($connect, "SELECT * FROM `suggestions` WHERE `nick` = '$nick' ORDER BY `nr` DESC")) {
      echo "<h1 class='text-center'>".$nick."</h1><hr>";
      while ($user = mysqli_fetch_assoc ($querynick)) {
        $nr = $user['nr'];
        if(!$user['edited']) echo "<a href='index.php?show=$nr'><p class='text-left'><b>".substr(strip_tags($user['title']), 0, 32)."</a></b></p><p cliass='text-right'><i>".strip_tags($user['date'])."</i> Author: <b><a href='users.php?nick=$nick'>".substr(strip_tags($user['nick']), 0, 22)."</a></b></i> | Votes: <b>".$user['votes']."</b></p><p class='text-right'>Status: <b>".$user['status']."</b></p>\n<hr>";
        if($user['edited']) echo "<a href='index.php?show=$nr'><p class='text-left'><b>".substr(strip_tags($user['title']), 0, 32)."</a></b></p><p cliass='text-right'><i>".strip_tags($user['date'])."</i> Author: <b><a href='users.php?nick=$nick'>".substr(strip_tags($user['nick']), 0, 22)."</a></b></i> | Votes: <b>".$user['votes']."</b></p><p class='text-right'>Status: <b>".$user['status']."</b> | Edited on: <b>".$user['edit_date']."</b></p>\n<hr>";
}
}
exit();
}

?>

<div class="container">
   <div>
      <div>
      <h1 class='text-center'>PHP - USERS</h1>
         <div>
            <div>
            <hr>
               <?php         
                  
if ($querylist = mysqli_query ($connect, "SELECT * FROM `users`")){
                  while ($list = mysqli_fetch_assoc ($querylist)) {
                      $nick = $list['login'];
                    echo "<p class='text-center'><b><a href='?nick=$nick'>".strip_tags($list['login'])."</a></b></p>";
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
