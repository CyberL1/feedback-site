<?php
require("../../../../inc/connect.php");

session_start();
if(!isset($_SESSION['login'])) {
	header('Location: ../../../login/login.php');
	exit();
}

$nick = $_SESSION['login'];
$nr = $_GET['nr'];


if ($query = mysqli_query($connect, "SELECT * FROM `suggestions`, `users` WHERE `nr`='$nr'")) {
	while ($del = mysqli_fetch_assoc ($query)) {
		if($del['nick'] !== $nick) {
			echo "<p>You cannot delete other users suggestions</p>";
			mysqli_close($connect);
			exit();
        } else {
            $nr = $del['nr'];
            mysqli_query($connect, "DELETE FROM `suggestions` WHERE `nr`='$nr'");
            mysqli_query($connect, "DELETE FROM `voters` WHERE `vote_nr`='$nr'");
            header('Location: ../my.php');
		}
	}
}

	   mysqli_close($connect);
?>