<?php
require("../../../inc/connect.php");
session_start();

if (!isset($_SESSION['login'])) { // checks if we are logined
	header('Location: /user/login');
	exit();
 }

 if($admincheck = mysqli_query ($connect, "SELECT * FROM `users` WHERE `admin` = '2' AND `login` = '$login'")) {
	while($isadmin = mysqli_fetch_assoc($admincheck)) {
	   include("../../../inc/menu-superadmin.php");
	}
 }
 
 mysqli_query($connect, "SELECT * FROM `users`");
 if($admincheck = mysqli_query ($connect, "SELECT * FROM `users` WHERE `admin` = '1' AND `login`='$login'")) {
	while($isadmin = mysqli_fetch_assoc($admincheck)) {
	   include("../../../inc/menu-admin.php");
	}
 }
 if($admincheck = mysqli_query ($connect, "SELECT * FROM `users` WHERE `admin` = '0' AND `login`='$login'")) {
	while($isadmin = mysqli_fetch_assoc($admincheck)) {
	 header('Location: ../../../user/login/login.php');
	 exit();
	}
 }

$nr = $_GET['nr'];

	mysqli_query($connect, "DELETE FROM `user_tickets` WHERE `nr`='$nr'");

	echo "<div class='alert-success'><span class=\"closebtn\" onclick=\"this.parentElement.style.display='none';\">&times;</span>Ticket deleted</div>";
	include("index.php");
	
	mysqli_close($connect);
?>