<?php
require("../../../inc/connect.php");
include("../../../inc/header.php");
?>

<?php
session_start();

if (!isset($_SESSION['login'])) { // checks if we are logined
	header('Location: /user/login');
	exit();
 }
 
$login = $_SESSION['login'];

if($admincheck = mysqli_query ($connect, "SELECT * FROM `users` WHERE `admin` != '2' AND `login` = '$login'")) {
	while($isadmin = mysqli_fetch_assoc($admincheck)) {
	   header('Location: ../user/login');
	   exit();
	}
 }

if($admincheck = mysqli_query ($connect, "SELECT * FROM `users` WHERE `admin` = '2' AND `login`='$login'")) {
   while($isadmin = mysqli_fetch_assoc($admincheck)) {
      include("../../../inc/menu-superadmin.php");
   }
}

?>

<div class="container">
	<div>
	<hr><br><br>
            <div class="text-center">
               <div>
                  <h1>CHANGE USER PERM</h1>
               </div>
               <div>
                  <form action="perm.php" method="POST">
                  <div class="form-group">
							<div class="col-lg-10">
								<input type="text" class="form-control" name="login" placeholder="Account username" required>
							</div><br>
						</div>
				  <div class="form-group">
						<div class="form-group">
							<div class="col-lg-10">
							<select name="perm">
								 <option>0 - User</option>
								 <option>1 - Admin</option>
							</select>
							</div><br>
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