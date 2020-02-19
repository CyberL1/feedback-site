<?php

	session_start();
	
	require '../../../inc/connect.php';

	$login = $_SESSION['login'];
    $old_pass = $_POST['ext_pass'];
    $new_pass = $_POST['new_pass'];
    $new_pass_hash = md5($_POST['new_pass']);
    $new_pass_again = $_POST['new_pass_again'];
	
	$query = mysqli_query($connect, "SELECT `password` FROM `users` WHERE `login` = '{$login}'");
	
	if(mysqli_num_rows($query) > 0) {
		$row = mysqli_fetch_array($query);
		if(md5($old_pass) === $row['password']) {
            if($new_pass == $new_pass_again) {
                mysqli_query($connect, "UPDATE `users` SET `password`='$new_pass_hash' WHERE `login`='{$login}'");
                unset($_SESSION['login']);
                session_destroy();
                header('Location: ../../login/login.php');
            } else {
                echo "<p>New passwords don't match</p>";
                include("change.php");
            }
		} else {
			echo '<p>Wrong old password</p><hr>'; // if old password is wrong
			include('change.php');

    }
}

	mysqli_close($connect);
	?>