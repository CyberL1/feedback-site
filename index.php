<?php

include("inc/header.php");

require 'inc/connect.php';

session_start();

if(!isset($_SESSION['login'])) {
    include("inc/menu.php");
} else {
    include("inc/menu-login.php");
}

if(isset($_GET['show'])) {
    $nr = $_GET['show'];

if ($querysuggestion = mysqli_query ($connect, "SELECT * FROM `suggestions` WHERE `nr` = '$nr'")) {
   while ($suggestion = mysqli_fetch_assoc($querysuggestion)) {
    $nick = $suggestion['nick'];
    $nr = $suggestion['nr'];
    $login = $_SESSION['login'];
    echo "<h1 class='text-center'>".strip_tags($suggestion['title'])."</h1>";
    $votecheck = mysqli_query($connect, "SELECT * FROM `voters` WHERE `vote_nr`='$nr' AND `voter`='$login'");
    if(mysqli_num_rows($votecheck)) {
       if(!$suggestion['edited']) echo "<br><p class='text-center'><a href='upvote.php?nr=$nr'>(+)</a> ".$suggestion['votes']."</p></a><hr><p class='text-left'><b>".substr(strip_tags($suggestion['content']), 0, 32)."</b></p><p cliass='text-right'><i>".$suggestion['date']."</i> Author: <b><a href='users.php?nick=$nick'>".substr(strip_tags($suggestion['nick']), 0, 22)."</b></a><p class='text-right'>Status: <b>".$suggestion['status']."</b></p>\n<hr>";
       if($suggestion['edited']) echo "<br><p class='text-center'><a href='upvote.php?nr=$nr'>(+)</a> ".$suggestion['votes']."</p></a><p class='text-center'>Edited on: <b>".$suggestion['edit_date']."</b></p><hr><p class='text-left'><b>".substr(strip_tags($suggestion['content']), 0, 32)."</b></p><p cliass='text-right'><i>".$suggestion['date']."</i> Author: <b><a href='users.php?nick=$nick'>".substr(strip_tags($suggestion['nick']), 0, 22)."</b></a><p class='text-right'>Status: <b>".$suggestion['status']."</b></p>\n<hr>";
    } else {
       if(!$suggestion['edited']) echo "<br><p class='text-center'><a href='upvote.php?nr=$nr'>[+]</a> ".$suggestion['votes']."</p></a><hr><p class='text-left'><b>".substr(strip_tags($suggestion['content']), 0, 32)."</b></p><p cliass='text-right'><i>".$suggestion['date']."</i> Author: <b><a href='users.php?nick=$nick'>".substr(strip_tags($suggestion['nick']), 0, 22)."</b></a><p class='text-right'>Status: <b>".$suggestion['status']."</b></p>\n<hr>";
       if($suggestion['edited']) echo "<br><p class='text-center'><a href='upvote.php?nr=$nr'>[+]</a> ".$suggestion['votes']."</p></a><p class='text-center'>Edited on: <b>".$suggestion['edit_date']."</b></p><hr><p class='text-left'><b>".substr(strip_tags($suggestion['content']), 0, 32)."</b></p><p cliass='text-right'><i>".$suggestion['date']."</i> Author: <b><a href='users.php?nick=$nick'>".substr(strip_tags($suggestion['nick']), 0, 22)."</b></a><p class='text-right'>Status: <b>".$suggestion['status']."</b></p>\n<hr>";
    }
    exit();
}
}
}

?>

<div>
   <div>
      <div>
         <div>
            <div>
            <h1 class="text-center">PHP - FEEDBACK</h1><hr>
               <?php
                  
                  if ($querylist = mysqli_query($connect, "SELECT * FROM `suggestions` ORDER BY nr DESC LIMIT 0,5")){
                     while ($list = mysqli_fetch_assoc($querylist)) {
                        $nr = $list['nr'];
                        $nick = $list['nick'];
                        if(!$list['edited']) echo "<a href='index.php?show=$nr'><p class='text-left'><b>".substr(strip_tags($list['title']), 0, 32)."</a></b></p><p cliass='text-right'><i>".strip_tags($list['date'])."</i> Author: <b><a href='users.php?nick=$nick'>".substr(strip_tags($list['nick']), 0, 22)."</a></b></i> | Votes: <b>".$list['votes']."</b></p><p class='text-right'>Status: <b>".$list['status']."</b></p>\n<hr>";
                        if($list['edited']) echo "<a href='index.php?show=$nr'><p class='text-left'><b>".substr(strip_tags($list['title']), 0, 32)."</a></b></p><p cliass='text-right'><i>".strip_tags($list['date'])."</i> Author: <b><a href='users.php?nick=$nick'>".substr(strip_tags($list['nick']), 0, 22)."</a></b></i> | Votes: <b>".$list['votes']."</b></p><p class='text-right'>Status: <b>".$list['status']."</b> | Edited on: <b>".$list['edit_date']."</b></p>\n<hr>";
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
