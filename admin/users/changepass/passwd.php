<?php

	session_start();
	
	require '../../../inc/connect.php';

	$login = $_POST['login'];
    $new_pass = $_POST['new_pass'];
    $new_pass_hash = md5($_POST['new_pass']);
    $new_pass_again = $_POST['new_pass_again'];

    if (!isset($_SESSION['login'])) { // checks if we are logined
        header('Location: /user/login/login.php');
        exit();
     }

     // Protect Super-admin account from modifying
	 if($superadmincheck = mysqli_query ($connect, "SELECT * FROM `users` WHERE `admin` = '2' AND `login` = '$login'")) {
		while($issuperadmin = mysqli_fetch_assoc($superadmincheck)) {
            echo "<div class='alert-error'><span class=\"closebtn\" onclick=\"this.parentElement.style.display='none';\">&times;</span>Cannot change passsword for super-admin account</div>";
            include("index.php");
			exit();
		   }
	   }
	
	$query = mysqli_query($connect, "SELECT `password` FROM `users` WHERE `login` = '$login'");
    
    if(mysqli_num_rows($query) > 0) {
        $row = mysqli_fetch_array($query);
        if($new_pass == $new_pass_again) {
            mysqli_query($connect, "UPDATE `users` SET `password`='$new_pass_hash' WHERE `login`='$login'");
            header('Location: index.php');
        } else {
        echo "<p>New passwords don't match</p>";
        include("index.php");
    }
} else {
    echo "<div class='alert-error'><span class=\"closebtn\" onclick=\"this.parentElement.style.display='none';\">&times;</span>Account $login does not exist</div>";
    include("index.php");
}

mysqli_close($connect);
?>