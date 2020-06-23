<?php
require("../../../inc/header.php");
require '../../../inc/connect.php';
session_start();

if(!isset($_SESSION['login'])) { // Checks if we are logined
	header('Location: ../../../login');
	exit();
}

$title = $_POST['title'];
$login = $_SESSION['login'];
$content = $_POST['content'];
$date = date("d m Y");

$query = mysqli_query($connect, "SELECT `email` FROM `users` WHERE `login` = '$login' AND `admin` = '1' or `admin` = '2'");
$fetch = mysqli_fetch_array($query);
$adminmail = $fetch['email'];

$query = mysqli_query($connect, "SELECT `email` FROM `users` WHERE `login` = '$login'");
$fetch = mysqli_fetch_array($query);
$usermail = $fetch['email'];

		mail($adminmail, "New support ticket", "$login has openned support ticket - $title");
	
	mysqli_query($connect, "INSERT INTO `user_tickets` SET title='$title', email='$usermail', nick='$login', content='$content', date='$date', status='open'");

	echo "<div class='alert-success'><span class=\"closebtn\" onclick=\"this.parentElement.style.display='none';\">&times;</span>Ticket opened</div>";
	include("index.php");

	   mysqli_close($connect);
?>
