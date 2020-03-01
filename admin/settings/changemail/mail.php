<?php

	session_start();
	
	require '../../../inc/connect.php';

	$login = $_SESSION['login'];
    $old_mail = $_POST['ext_mail'];
    $new_mail = $_POST['new_mail'];
    $new_mail_again = $_POST['new_mail_again'];
	
	$query = mysqli_query($connect, "SELECT `email` FROM `users` WHERE `login` = '{$login}'");
	
	if(mysqli_num_rows($query) > 0) {
		$row = mysqli_fetch_array($query);
		if($old_mail === $row['email']) {
            if($new_mail == $new_mail_again) {
                mysqli_query($connect, "UPDATE `users` SET `email`='$new_mail' WHERE `login`='{$login}'");
                header('Location: ../settings.php');
            } else {
                echo "<p>New e-mails don't match</p>";
                include("change.php");
            }
		} else {
			echo '<p>Wrong old e-mail</p><hr>'; // if old e-mail is wrong
			include('change.php');

    }
}

	mysqli_close($connect);
	?>