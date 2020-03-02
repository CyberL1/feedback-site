<?php
require("../../../inc/connect.php");
include("../../../inc/header.php");

session_start();

if (!isset($_SESSION['login'])) { // checks if we are logined
    header('Location: ../../login/login.php');
    exit();
}
$login = $_SESSION['login'];
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

<div class="container">
	<div>
	<hr><br><br>
            <div class="text-center">
               <div>
                  <h1>DELETE ACCOUNT</h1>
               </div>
               <div>
                  <form action="delacc.php" method="POST" class="form-horizontal" id="changePassForm">
						<div class="form-group">
							<div class="col-lg-10">
								<input type="password" class="form-control" name="password" placeholder="Enter password" required>
							</div><br>
						</div>
						</div>
						<div class="form-group">
							<div class="col-lg-10 col-lg-offset-2"><br>
								<button class="btn btn-success hvr-grow">[ DELETE ]</button><br><br><a href="../settings.php" class="btn btn-success hvr-grow">[ BACK ]</a><br><br>
							</div>
						 </div>

</form>
</div>
</div>
</div>