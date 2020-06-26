<?php

	session_start();
	
	require '../../../inc/connect.php';

	if (!isset($_SESSION['login'])) { // checks if we are logined
		header('Location: /user/login/login.php');
		exit();
	 }
	 
	$login = $_POST['login'];
    $subject = $_POST['subject'];
    $content = $_POST['content'];
	   
	$query = mysqli_query($connect, "SELECT `email` FROM `users` WHERE `login` = '$login'");
	$fetch = mysqli_fetch_array($query);
	$email = $fetch['email'];

	$content = wordwrap($content, 70, "\r\n");
	if(mysqli_num_rows($query) > 0) {
		mail($email, $subject, $content);
		echo "<div class='alert-success'><span class=\"closebtn\" onclick=\"this.parentElement.style.display='none';\">&times;</span>Mail sent to: $login ($email)</div>";
		include('index.php');
	} else {
		echo "<div class='alert-error'><span class=\"closebtn\" onclick=\"this.parentElement.style.display='none';\">&times;</span>Account with username $login does not exist</div>";
		include('index.php');
	}

mysqli_close($connect);
?>
