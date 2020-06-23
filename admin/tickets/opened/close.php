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
 
 if($admincheck = mysqli_query ($connect, "SELECT * FROM `users` WHERE `admin` = '1' AND `login`='$login'")) {
	while($isadmin = mysqli_fetch_assoc($admincheck)) {
	   include("../../../inc/menu-admin.php");
	}
 }
 if($admincheck = mysqli_query ($connect, "SELECT * FROM `users` WHERE `admin` = '0' AND `login`='$login'")) {
	while($isadmin = mysqli_fetch_assoc($admincheck)) {
	 header('Location: ../../../user/login');
	 exit();
	}
 }

$nr = $_GET['nr'];

	 // Do not re-close closed tickets
	 if($closedcheck = mysqli_query ($connect, "SELECT `status` FROM `user_tickets` WHERE `status` = 'closed' AND `nr` = '$nr'")) {
		while($isclosed = mysqli_fetch_assoc($closedcheck)) {
			echo "<div class='alert-error'><span class=\"closebtn\" onclick=\"this.parentElement.style.display='none';\">&times;</span>Cannot te-close closed ticket</div>";
			include('index.php');
			exit();
		   }
	   }

	   mysqli_query($connect, "UPDATE `user_tickets` SET `status` = 'closed' WHERE `nr` = '$nr'");
	   $query = mysqli_query($connect, "SELECT * FROM `user_tickets` WHERE `nr` = '$nr'");
	   $query = mysqli_fetch_array($query);
	   $email = $query['email'];

	mail($email, "Closed ticket: $nr", "Your ticket (id: $nr) has been closed, if you have more questions, feel free to open next ticket");

	echo "<div class='alert-success'><span class=\"closebtn\" onclick=\"this.parentElement.style.display='none';\">&times;</span>Ticket closed</div>";
	include("index.php");

	mysqli_close($connect);
?>