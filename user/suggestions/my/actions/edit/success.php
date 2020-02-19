<?php
session_start();

if(!isset($_SESSION['login'])) {
	header('Location: ../../../../../login.php');
	exit();
}

$title = $_POST['title'];
$nick = $_SESSION['login'];
$content = $_POST['content'];
$nr = $_GET['nr'];
$date = date("d m Y");

require("../../../../../inc/connect.php");

if ($query = mysqli_query($connect, "SELECT * FROM `suggestions`, `users` WHERE `nr`='$nr'")) {
	while ($edit = mysqli_fetch_assoc ($query)) {
		if($edit['nick'] !== $nick) {
			echo "<p>You cannot modify other user suggestions</p>";
			mysqli_close($connect);
			exit();
		} else {
		$nr = $edit['nr'];
		mysqli_query($connect, "UPDATE `suggestions` SET title='$title', content='$content', edit_date='$date', edited='1' WHERE `nr`='$nr'");
		header('Location: ../../my.php');
		}
	}
}

	   mysqli_close($connect);
?>
