<?php
require("../../../../inc/connect.php");
include ("../../../../inc/header.php");

session_start();

if (!isset($_SESSION['login'])) { // checks if we are logined
	header('Location: /user/login');
	exit();
 }
 
$login = $_SESSION['login'];
$nr = $_GET['nr'];

mysqli_query($connect, "SELECT * FROM `user_tickets`");
if($opencheck = mysqli_query ($connect, "SELECT * FROM `user_tickets` WHERE `status`='closed' AND `nr`='$nr'")) {
   while($isopen = mysqli_fetch_assoc($opencheck)) {
	  echo("Cannot comment closed ticket");
	  exit();
   }
}

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
	Header("Location: ../../../../user/login");
	exit();
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
					<form action="success.php?nr=<?php echo $nr ?>" method="POST">
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