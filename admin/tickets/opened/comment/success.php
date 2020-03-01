<?php
require("../../../../inc/header.php");
require("../../../../inc/connect.php");
session_start();

if(!isset($_SESSION['login'])) {
	header('Location: ../../../../login.php');
	exit();
}

$nr = $_GET['nr'];
$author = $_SESSION['login'];
$content = $_POST['content'];
$date = date("d m Y");
	
	mysqli_query($connect, "INSERT INTO `ticket_comments` SET ticket_nr='$nr', author='$author', content='$content', date='$date'");

	   header("Location: ../opened.php?show=$nr");

	   mysqli_close($connect);
?>
