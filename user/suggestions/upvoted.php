<?php

include("../../inc/header.php");

require '../../inc/connect.php';

session_start();

if(!isset($_SESSION['login'])) {
    header('Location: ../../index.php');
    exit();
}

include('../../inc/menu-login.php');

if ($upvotedquery = mysqli_query ($connect, "SELECT * FROM `suggestions` ORDER BY `nr` DESC")) {
    echo "<h1 class='text-center'>Upvoted suggestions<br></h1><hr>";
   while ($upvoted = mysqli_fetch_assoc($upvotedquery)) {
    $nick = $upvoted['nick'];
    $nr = $upvoted['nr'];
    $login = $_SESSION['login'];
    $votecheck = mysqli_query($connect, "SELECT * FROM `voters` WHERE `vote_nr`='$nr' AND `voter`='$login'");
    if(mysqli_num_rows($votecheck)) {
        if(!$upvoted['edited']) echo "<a href='index.php?show=$nr'><p class='text-left'><b>".substr(strip_tags($upvoted['title']), 0, 32)."</a></b></p><p cliass='text-right'><i>".strip_tags($upvoted['date'])."</i> Author: <b><a href='users.php?nick=$nick'>".substr(strip_tags($upvoted['nick']), 0, 22)."</a></b></i> | Votes: <b>".$upvoted['votes']."</b></p><p class='text-right'>Status: <b>".$upvoted['status']."</b></p>\n<hr>";
        if($upvoted['edited']) echo "<a href='index.php?show=$nr'><p class='text-left'><b>".substr(strip_tags($upvoted['title']), 0, 32)."</a></b></p><p cliass='text-right'><i>".strip_tags($upvoted['date'])."</i> Author: <b><a href='users.php?nick=$nick'>".substr(strip_tags($upvoted['nick']), 0, 22)."</a></b></i> | Votes: <b>".$upvoted['votes']."</b></p><p class='text-right'>Status: <b>".$upvoted['status']."</b> | Edited on: <b>".$upvoted['edit_date']."</b></p>\n<hr>";
    }
}
}

mysqli_close($connect);
?>