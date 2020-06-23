<?php

	session_start();
	
	require '../../inc/connect.php';

	$login = $_POST['login'];
	$password = $_POST['password'];
	
	$query = mysqli_query($connect, "SELECT `password` FROM `users` WHERE `login` = '$login'");
	
	if(mysqli_num_rows($query) > 0) {
		$row = mysqli_fetch_array($query);
		
		if(md5($password) === $row['password']) {
			$_SESSION['login'] = $login;
			header("Location: ../../index.php");
		} else {
			echo "<div class='alert-error'><span class=\"closebtn\" onclick=\"this.parentElement.style.display='none';\">&times;</span>Wrong password</div>"; // if password is wrong
			include('index.php');
		}
	} else {
		echo "<div class='alert-error'><span class=\"closebtn\" onclick=\"this.parentElement.style.display='none';\">&times;</span>Wrong username</div>"; // if username is wrong
		include('index.php');
	}

	mysqli_close($connect);
	?>