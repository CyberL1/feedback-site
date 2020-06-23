<?php

	session_start();
	
	require '../../../inc/connect.php';

	if (!isset($_SESSION['login'])) { // checks if we are logined
		header('Location: /user/login/login.php');
		exit();
	 }
	 
	$login = $_POST['login'];
    $new_mail = $_POST['new_mail'];
    $new_mail_again = $_POST['new_mail_again'];
	
	// Protect Super-admin account from modifying
	if($superadmincheck = mysqli_query ($connect, "SELECT * FROM `users` WHERE `admin` = '2' AND `login` = '$login'")) {
		while($issuperadmin = mysqli_fetch_assoc($superadmincheck)) {
			echo "<div class='alert-error'><span class=\"closebtn\" onclick=\"this.parentElement.style.display='none';\">&times;</span>Cannot change e-mail for super-admin account</div>";
			include("index.php");
			exit();
		   }
	   }
	   
	$query = mysqli_query($connect, "SELECT `email` FROM `users` WHERE `login` = '$login'");
	
	if(mysqli_num_rows($query) > 0) {
		if($new_mail == $new_mail_again) {
        mysqli_query($connect, "UPDATE `users` SET `email`='$new_mail' WHERE `login`='$login'");
		Header('Location: index.php');
	} else {
		echo "<div classs='alert-error'><span class=\"closebtn\" onclick=\"this.parentElement.style.display='none';\">&times;</span>New e-mails don't match</div>";
		include("index.php");
	}
} else {
	echo "<div class='alert-error'><span class=\"closebtn\" onclick=\"this.parentElement.style.display='none';\">&times;</span>Account $login does not exist</div>";
	include("index.php");
}

mysqli_close($connect);
?>