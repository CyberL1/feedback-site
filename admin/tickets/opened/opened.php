<?php
include("../../../inc/header.php"); 
require("../../../inc/connect.php");
?>
<?php
session_start();

$login = $_SESSION['login'];
mysqli_query($connect, "SELECT * FROM `users`");
if($admincheck = mysqli_query ($connect, "SELECT * FROM `users` WHERE `admin` = '1' AND `login`='$login'")) {
   while($isadmin = mysqli_fetch_assoc($admincheck)) {
      include("../../../inc/menu-admin.php");
   }
}
if($admincheck = mysqli_query ($connect, "SELECT * FROM `users` WHERE `admin` = '0' AND `login`='$login'")) {
   while($isadmin = mysqli_fetch_assoc($admincheck)) {
    header('Location: ../../../user/login/login.php');
    exit();
   }
}

if(isset($_GET['show'])) {
   $nr = $_GET['show'];

if ($queryticket = mysqli_query ($connect, "SELECT * FROM `user_tickets` WHERE `nr` = '$nr'")) {
  while ($ticket = mysqli_fetch_assoc($queryticket)) {
   $nick = $ticket['nick'];
   $nr = $ticket['nr'];
   $login = $_SESSION['login'];
   echo "<h1 class='text-center'>".strip_tags($ticket['title'])."</h1>";
   echo "<p class='text-center'><hr><p class='text-left'><b>".substr(strip_tags($ticket['content']), 0, 32)."</b></p><p cliass='text-right'><i>".$ticket['date']."</i> Author: <b><a href='users.php?nick=$nick'>".substr(strip_tags($ticket['nick']), 0, 22)."</b></a><p class='text-right'>Status: <b>".$ticket['status']."</b> | <b><a href='comment/comment.php?nr=$nr'>[ COMMENT ]</a></b></p>\n<hr><h2 class='text-center'>Comments</h2>";
   if($querycomments = mysqli_query($connect, "SELECT * FROM `ticket_comments` WHERE `ticket_nr`='$nr'")) {
      while ($ticketcomment = mysqli_fetch_assoc($querycomments)) {
         $author = $ticketcomment['author'];
         echo "<hr><p cliass='text-left'><i>".strip_tags($ticketcomment['content'])."<br><br>".$ticketcomment['date']."</b></i> Author: <b><a href='users.php?nick=$author'>".substr(strip_tags($ticketcomment['author']), 0, 22)."</a></b></i></b></p>\n";
      }
      echo "<hr>";
   }
}
}
exit();
}

?>
<div class="container">
   <div>
   <h1 class="text-center">Opened tickets</h1>
      <div>
         <div>
            <div>
			<hr>
               <?php
               $login = $_SESSION['login'];
                  if ($query = mysqli_query($connect, "SELECT * FROM `user_tickets` ORDER BY `nr` DESC")) {
                     while ($my = mysqli_fetch_assoc ($query)) {
                       $nr = $my['nr'];
                       $login = $_SESSION['login'];
                       $nick = $my['nick'];
                       echo "<a href='opened.php?show=$nr'><p class='text-left'><b>".substr(strip_tags($my['title']), 0, 32)."</a></b></p><p cliass='text-right'><i>".strip_tags($my['date'])."</i> Author: <b><a href='users.php?nick=$nick'>".substr(strip_tags($my['nick']), 0, 22)."</a></b></i></b></p><p class='text-right'>Status: <b>".$my['status']."</b></p>\n<hr>";
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
