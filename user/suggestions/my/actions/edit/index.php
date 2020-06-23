<?php
require("../../../../../inc/connect.php");
include("../../../../../inc/header.php");
?>

<?php
session_start();
if (!isset($_SESSION['login'])) { // checks if we are logined
    header('Location: ../../../../login');
    exit();
}

$login = $_SESSION['login'];

if($admincheck = mysqli_query ($connect, "SELECT * FROM `users` WHERE `admin` = '2' AND `login` = '$login'")) {
	while($isadmin = mysqli_fetch_assoc($admincheck)) {
	   include("../../../../../inc/menu-superadmin.php");
	}
 }

mysqli_query($connect, "SELECT * FROM `users`");
if($admincheck = mysqli_query ($connect, "SELECT * FROM `users` WHERE `admin` = '1' AND `login`='$login'")) {
   while($isadmin = mysqli_fetch_assoc($admincheck)) {
      include("../../../../../inc/menu-admin.php");
   }
}
if($admincheck = mysqli_query ($connect, "SELECT * FROM `users` WHERE `admin` = '0' AND `login`='$login'")) {
   while($isadmin = mysqli_fetch_assoc($admincheck)) {
    include("../../../../../inc/menu-login.php");
   }
}

if(isset($_GET['nr'])) {
	$nr = $_GET['nr'];
	if ($query = mysqli_query($connect, "SELECT * FROM `suggestions`, `users` WHERE `nr`='$nr'")) {
		while ($edit = mysqli_fetch_assoc ($query)) {
			$nr = $edit['nr'];
			if($edit['nick'] !== $_SESSION['login']) {
				echo '<p>You cannot edit other users suggestions</p>';
				mysqli_close($connect);
				exit();
			} else {
				echo "<center><div class='container'>";
echo "<form action='success.php?nr=$nr' method='POST' class='form-horizontal' id='suggestionEditForm'>";
	echo "<div>";
		echo "<br><br>";
		echo "<div>";
			echo "<div>";
				echo "<div>";
					echo "<div>";
						echo "<h2>Edit suggestion #$nr</h2>";
					echo "</div>";
					if ($query = mysqli_query($connect, "SELECT * FROM `suggestions` WHERE `nr`=$nr")) {
						while ($edit = mysqli_fetch_assoc ($query)) {
							$content = $edit['content'];
							$title = $edit['title'];
						   echo "<form action='success.php' method='post' id='suggestionForm' class='form-horizontal'>";
						   echo "<div>";
						   echo "<div>";
								   echo "<input type='text' id='clean' class='form-control' name='title' placeholder='Title' value='$title' max='211' required>";
							   echo "</div>";
						   echo "</div><br>";
						   echo "<div>";
							   echo "<div>";
								   echo "<textarea class='form-control' rows='3' name='content' id='clean' placeholder='Content' required>$content</textarea>";
							   echo "</div>";
						   echo "</div>";
						   echo "<div'>";
							   echo "<div'>";
								   echo "<button type='reset' class='btn btn-primary'>Reset</button>";
								   echo "<input type='submit' class='btn btn-success' value='Edit'>";
							   echo "</div>";
						   echo "</div>";
					   echo "</form>";
					echo "</div>";
				echo "</div>";
			echo "</div>";
		echo "</div>";
		echo "<br>";
	echo "</div></center>";
                        }
					}
				}
			}
		}
	}
	mysqli_close($connect);
?>