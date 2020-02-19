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
	<div class="row">
	<hr><br><br>
            <div class="text-center">
               <div>
                  <h1>CHANGE E-MAIL</h1>
               </div>
               <div>
                  <form action="mail.php" method="POST" class="form-horizontal" id="changeEmailForm">
                  <div class="form-group">
							<div class="col-lg-10">
								<input type="email" class="form-control" name="ext_mail" placeholder="Existing e-mail" required>
							</div><br>
						</div>
						<div class="form-group">
							<div class="col-lg-10">
								<input type="email" class="form-control" name="new_mail" placeholder="New e-mail" required>
							</div><br>
						</div>

						<div class="form-group">
							<div class="col-lg-10">
								<input type="email" class="form-control" name="new_mail_again" placeholder="New e-mail again" required>
							</div>
						</div>
						<div class="form-group">
							<div class="col-lg-10 col-lg-offset-2"><br>
								<button class="btn btn-success hvr-grow">[ CHANGE ]</button><br><br><a href="../settings.php" class="btn btn-success hvr-grow">[ BACK ]</a><br><br>
							</div>
						 </div>

</form>
</div>
</div>
	</div>
</div>
<?php mysqli_close($connect); ?>