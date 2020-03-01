<?php
require("../../../inc/connect.php");
include("../../../inc/header.php");
?>
<?php
session_start();
if (!isset($_SESSION['login'])) { // checks if we are logined
    header('Location: ../../login/login.php');
    exit();
}
?>
<div class="container">
<?php include("../../../inc/menu-login.php"); ?>
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
<?php mysqli_close($connect); ?>