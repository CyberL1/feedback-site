<?php
	session_start();

	require('../../inc/connect.php');

	$login = $_POST['login'];
	$password = md5($_POST['password']);
	$email = $_POST['email'];

	$sqlchecklogin = mysqli_query($connect, "SELECT * FROM `users` WHERE login='$login'");
	$sqlcheckmail = mysqli_query($connect, "SELECT * FROM `users` WHERE email='$email'");

	if(strlen($login) > 22) {
		echo "Nick cannot be longer than 22 characters";
	} else if(mysqli_num_rows($sqlchecklogin) > 0) {
		echo "A user with this nick exists already";
	} else if(mysqli_num_rows($sqlcheckmail) > 0) {
		echo "A user wih this e-mail exists already";
   } else {

	$sql = "INSERT INTO `users` SET login='$login', password='$password', email='$email'";
	$query = mysqli_query($connect, $sql);
	
	header("Location: ../login/login.php");

	mysqli_close($connect);

   }

?>