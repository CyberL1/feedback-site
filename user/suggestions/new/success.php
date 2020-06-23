<?php
require("../../../inc/header.php");
require '../../../inc/connect.php';
session_start();

if(!isset($_SESSION['login'])) { // Checks if we are logined
	header('Location: ../../../login');
	exit();
}

$title = $_POST['title'];
$nick = $_SESSION['login'];
$content = $_POST['content'];
$date = date("d m Y");
	
	mysqli_query($connect, "INSERT INTO `suggestions` SET title='$title', nick='$nick', content='$content', date='$date', edited='0', votes='0', edit_date='Not edited', status='Posted'");

	echo "<div class='alert-success'><span class=\"closebtn\" onclick=\"this.parentElement.style.display='none';\">&times;</span>Suggestion posted</div>";
	include('index.php');

	   mysqli_close($connect);
?>
