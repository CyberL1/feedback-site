<?php include ("../../../../inc/header.php"); ?>
<?php
require("../../../../inc/connect.php");

session_start();
if (!isset($_SESSION['login'])) { // checks if we are logined
    header('Location: ../../../login');
    exit();
}

$login = $_SESSION['login'];

if($admincheck = mysqli_query ($connect, "SELECT * FROM `users` WHERE `admin` = '2' AND `login` = '$login'")) {
	while($isadmin = mysqli_fetch_assoc($admincheck)) {
	   include("../../../../inc/menu-superadmin.php");
	}
 }

mysqli_query($connect, "SELECT * FROM `users`");
if($admincheck = mysqli_query ($connect, "SELECT * FROM `users` WHERE `admin` = '1' AND `login`='$login'")) {
   while($isadmin = mysqli_fetch_assoc($admincheck)) {
      include("../../../../inc/menu-admin.php");
   }
}

if($admincheck = mysqli_query ($connect, "SELECT * FROM `users` WHERE `admin` = '0' AND `login`='$login'")) {
   while($isadmin = mysqli_fetch_assoc($admincheck)) {
    include("../../../../inc/menu-login.php");
   }
}
$nr = $_GET['nr'];
if ($query = mysqli_query($connect, "SELECT * FROM `user_tickets` WHERE `nr`='$nr'")) {
	while ($auth = mysqli_fetch_assoc ($query)) {
	   $nr = $auth['nr'];
	   if($auth['nick'] !== $_SESSION['login']) {
		  echo '<p>You cannot comment other users tickets</p>';
		  mysqli_close($connect);
		  exit();
	   } else {
		   continue;
	   }
	}
}
?>
<div class="container">
<center>
	<div>
		<br><br>
		<div>
			<div>
				<div>
					<div><h2>Comment ticket #<?php echo $nr ?></h2></div>
					<form action="success.php?nr=<?php echo $nr ?>" method="post" id="commentForm" class="form-horizontal">
						</div><br>
						<div class="form-group">
							<div class="col-lg-10">
								<textarea class="form-control" rows="3" name="content" id="clean" placeholder="Content"></textarea>
							</div>
						</div>
						</div>
						<div class="form-group">
							<div class="col-lg-10 col-lg-offset-2">
								<button type="reset" class="btn btn-primary">Clear</button>
								<input type="submit" class="btn btn-success" value="Add">
							</div>
						</div>
					</form>

					</div>
					
				</div>
			</div>
		</div>
		<br>
	</div>
</div></center>
<?php mysqli_close($connect); ?>