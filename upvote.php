<?php

require 'inc/connect.php';

session_start();

if(!isset($_SESSION['login'])) {
    header('Location: user/login/login.php');
    exit();
}

if (!isset($_GET['nr'])) {
    echo 'Suggestion nr incorrect';
}

$nr = $_GET['nr'];
$voter = $_SESSION['login'];

        if ($votequery = mysqli_query($connect, "SELECT * FROM `suggestions`, `users` WHERE `nr`='$nr' AND `login`='$voter'")) {
            while ($vote = mysqli_fetch_assoc($votequery)) {
             $nr = $vote['nr'];
             $voter = $vote['login'];
             mysqli_query($connect, "INSERT INTO `voters` (`vote_nr`, `voter`) VALUES ($nr, $voter)");
             $result = mysqli_query($connect, "SELECT * FROM `voters` WHERE `vote_nr`='$nr' AND `voter`='$voter'");
             if(mysqli_num_rows($result)){
                 mysqli_query($connect, "UPDATE `suggestions` SET `votes`=`votes`-1 WHERE `nr` = $nr");
                 mysqli_query($connect, "DELETE FROM `voters` WHERE `vote_nr`='$nr' AND `voter`='$voter'");
                 header("Location: index.php?show=$nr");
             } else {
                 mysqli_query($connect, "UPDATE `suggestions` SET `votes`=`votes`+1 WHERE `nr` = $nr");
                 mysqli_query($connect, "INSERT INTO `voters` (`vote_nr`, `voter`) VALUES ('$nr', '$voter')");
                 header("Location: index.php?show=$nr");
                }
            }
        }
        
        mysqli_close($connect);
?>