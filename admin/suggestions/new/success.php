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
	
	mysqli_query($connect, "INSERT INTO `suggestions` SET title='$title', nick='$nick', content='$content', date='$date', edited='0', votes='0', edit_date='Not edited', status='Posted'");

	   header('Location: ../../../index.php');

	   mysqli_close($connect);
?>
