<?php
	
	require('../../inc/connect.php');

    $email = $_POST['email'];
    $login = $_POST['login'];
    $pass = $_POST['pass'];
    $pass_hash = md5($_POST['pass']);
    $pass_again = $_POST['pass_again'];

		if($pass === $pass_again) {
                mysqli_query($connect, "INSERT INTO `users` (`login`, `password`, `email`, `admin`) VALUES ('$login', '$pass_hash', '$email', 2)");
                Header('Location: ../done');
            } else {
                echo "<p>Passwords don't match</p>";
                include("index.php");
            }
	?>
