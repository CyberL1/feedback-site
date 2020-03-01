<?php include("../../../../../inc/header.php"); ?>

<?php
session_start();
if(!isset($_SESSION['login'])) { // checks if we are logined
header('Location: ../../../../login/login.php');
exit();
}

require "../../../../../inc/connect.php";

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
include("../../../../../inc/menu-login.php");
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
								   echo "<textarea class='form-control' rows='3' name='content' id='clean' placeholder='Content'>$content</textarea>";
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