<?php
require("../../../inc/connect.php");
include("../../../inc/header.php");
?>

<?php
session_start();

if (!isset($_SESSION['login'])) { // checks if we are logined
	header('Location: /user/login/login.php');
	exit();
 }
 
$login = $_SESSION['login'];

if($admincheck = mysqli_query ($connect, "SELECT * FROM `users` WHERE `admin` = '2' AND `login` = '$login'")) {
	while($isadmin = mysqli_fetch_assoc($admincheck)) {
		include("../../../inc/menu-superadmin.php");
	}
 }

if($admincheck = mysqli_query ($connect, "SELECT * FROM `users` WHERE `admin` = '1' AND `login`='$login'")) {
   while($isadmin = mysqli_fetch_assoc($admincheck)) {
      include("../../../inc/menu-admin.php");
   }
}
if($admincheck = mysqli_query ($connect, "SELECT * FROM `users` WHERE `admin` = '0' AND `login`='$login'")) {
   while($isadmin = mysqli_fetch_assoc($admincheck)) {
	header('Location: /user/login');
	exit();
   }
}
?>

<div class="container">
	<div>
	<hr><br><br>
            <div class="text-center">
               <div>
                  <h1>CHANGE PASSWORD</h1>
               </div>
               <div>
                  <form action="passwd.php" method="POST" class="form-horizontal" id="changePassForm">
                  <div class="form-group">
							<div class="col-lg-10">
								<input type="text" class="form-control" name="login" placeholder="Account username" required>
							</div><br>
						</div>
				  <div class="form-group">
						<div class="form-group">
							<div class="col-lg-10">
								<input type="password" class="form-control" name="new_pass" placeholder="New password" required>
							</div><br>
						</div>

						<div class="form-group">
							<div class="col-lg-10">
								<input type="password" class="form-control" name="new_pass_again" placeholder="New password again" required>
							</div>
						</div>
						<div class="form-group">
							<div class="col-lg-10 col-lg-offset-2"><br>
								<button class="btn btn-success hvr-grow">[ CHANGE ]</button><br><br><a href=".." class="btn btn-success hvr-grow">[ BACK ]</a><br><br>
							</div>
						 </div>

</form>
</div>
</div>
	</div>
</div>
<?php mysqli_close($connect); ?>