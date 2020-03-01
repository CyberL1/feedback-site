<?php
require("../../../../inc/header.php");
require("../../../../inc/connect.php");
session_start();

if(!isset($_SESSION['login'])) {
	header('Location: ../../../../login.php');
	exit();
}

$nr = $_GET['nr'];

if ($query = mysqli_query($connect, "SELECT * FROM `user_tickets` WHERE `nr`='$nr'")) {
	while ($auth = mysqli_fetch_assoc ($query)) {
	   $nr = $auth['nr'];
	   if($auth['nick'] !== $_SESSION['login']) {
		  echo '<p>You cannot comment other users tickets</p>';
		  mysqli_close($connect);
		  exit();
	   } else {
		   continue;
	   }
	}
}

$author = $_SESSION['login'];
$content = $_POST['content'];
$date = date("d m Y");
	
	mysqli_query($connect, "INSERT INTO `ticket_comments` SET ticket_nr='$nr', author='$author', content='$content', date='$date'");

	   header("Location: ../my.php?show=$nr");

	   mysqli_close($connect);
?>
