<?php
require("../../../inc/header.php");
require '../../../inc/connect.php';
session_start();

if(!isset($_SESSION['login'])) {
	header('Location: ../../../login.php');
	exit();
}

$title = $_POST['title'];
$nick = $_SESSION['login'];
$content = $_POST['content'];
$date = date("d m Y");
	
	mysqli_query($connect, "INSERT INTO `user_tickets` SET title='$title', nick='$nick', content='$content', date='$date', status='open'");

	   header('Location: ../../../index.php');

	   mysqli_close($connect);
?>
