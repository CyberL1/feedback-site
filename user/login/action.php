<?php

	session_start();
	
	require '../../inc/connect.php';

	$login = $_POST['login'];
	$password = $_POST['password'];
	
	$query = mysqli_query($connect, "SELECT `password` FROM `users` WHERE `login` = '{$login}'");
	
	if(mysqli_num_rows($query) > 0) {
		$row = mysqli_fetch_array($query);
		
		if(md5($password) === $row['password']) {
			$_SESSION['login'] = $login;
			header("Location: ../../index.php");
		} else {
			echo '<p>Wrong password</p><hr>'; // if password is wrong
			include('login.php');
		}
	} else {
		echo '<p>Wrong username</p><hr>'; // if username is wrong
		include('login.php');
	}

	mysqli_close($connect);
	?>