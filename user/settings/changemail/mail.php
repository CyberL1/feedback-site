<?php

	session_start();
	
	require '../../../inc/connect.php';

	$login = $_SESSION['login'];
    $old_mail = $_POST['ext_mail'];
    $new_mail = $_POST['new_mail'];
	$new_mail_again = $_POST['new_mail_again'];
	
	if (!isset($_SESSION['login'])) { // checks if we are logined
		header('Location: ../../login');
		exit();
	}
	
	$query = mysqli_query($connect, "SELECT `email` FROM `users` WHERE `login` = '$login'");
	
	if(mysqli_num_rows($query) > 0) {
		$row = mysqli_fetch_array($query);
		if($old_mail === $row['email']) {
            if($new_mail == $new_mail_again) {
				mysqli_query($connect, "UPDATE `users` SET `email`='$new_mail' WHERE `login`='$login'");
				echo "<div class='alert-success'><span class=\"closebtn\" onclick=\"this.parentElement.style.display='none';\">&times;</span>Email changed</div>";
                include('index.php');
            } else {
                echo "<div class='alert-error'><span class=\"closebtn\" onclick=\"this.parentElement.style.display='none';\">&times;</span>New emails don't math</div>";
                include("index.php");
            }
		} else {
			echo "<div class='alert-error'><span class=\"closebtn\" onclick=\"this.parentElement.style.display='none';\">&times;</span>Wrong old email/div>"; // if old e-mail is wrong
			include('index.php');

    }
}

	mysqli_close($connect);
	?>