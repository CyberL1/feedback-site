<?php
require("../../../../inc/header.php");
require("../../../../inc/connect.php");
session_start();
if (!isset($_SESSION['login'])) { // checks if we are logined
	header('Location: /user/login');
	exit();
}

$nr = $_GET['nr'];

$query = mysqli_query($connect, "SELECT `nick` FROM `user_tickets` WHERE `nr` = '$nr'");
$fetch = mysqli_fetch_array($query);

$author = $_SESSION['login'];
$ticketauthor = $fetch['nick'];
$content = $_POST['content'];
$date = date("d m Y");

$query = mysqli_query($connect, "SELECT `email` FROM `user_tickets` WHERE `nick` = '$ticketauthor'");
$fetch = mysqli_fetch_array($query);
$usermail = $fetch['email'];

		mail($usermail, "New comment on support ticket", "$author has commented support ticket $nr\r\n\r\n$content");

	if($content) mysqli_query($connect, "INSERT INTO `ticket_comments` SET ticket_nr='$nr', author='$author', content='$content', date='$date'");

	   header("Location: ..?show=$nr");

	   mysqli_close($connect);
?>