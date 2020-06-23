<?php include ("../../../inc/header.php"); ?>
<?php
require("../../../inc/connect.php");

session_start();
if (!isset($_SESSION['login'])) { // checks if we are logined
    header('Location: ../../login');
    exit();
}

$login = $_SESSION['login'];

if($admincheck = mysqli_query ($connect, "SELECT * FROM `users` WHERE `admin` = '2' AND `login` = '$login'")) {
	while($isadmin = mysqli_fetch_assoc($admincheck)) {
	   include("../../../inc/menu-superadmin.php");
	}
 }

mysqli_query($connect, "SELECT * FROM `users`");
if($admincheck = mysqli_query ($connect, "SELECT * FROM `users` WHERE `admin` = '1' AND `login`='$login'")) {
   while($isadmin = mysqli_fetch_assoc($admincheck)) {
      include("../../../inc/menu-admin.php");
   }
}
if($admincheck = mysqli_query ($connect, "SELECT * FROM `users` WHERE `admin` = '0' AND `login`='$login'")) {
   while($isadmin = mysqli_fetch_assoc($admincheck)) {
    include("../../../inc/menu-login.php");
   }
}
?>

<div class="container"><center>
	<div>
		<br><br>
		<div>
			<div>
				<div>
					<div><h2>Open a ticket</h2></div>
					<form action="success.php" method="post" id="suggestionForm" class="form-horizontal">
						
						<div class="form-group">
							<div class="col-lg-10">
								<input type="text" id="clean" class="form-control" name="title" placeholder="Title" max="211" required>
							</div>
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