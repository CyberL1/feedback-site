<?php require("../../inc/header.php"); ?>

<div class="container">
<?php include("../../inc/menu.php"); ?>
	<div class="row"><hr><br><br>
            <div class="text-center">
               <div>
                  <h1>REGISTER</h1>
               </div>
               <div>
                  <form action="action.php" method="POST" class="form-horizontal" id="registerForm">
				  
				  <div class="form-group">
							<div class="col-lg-10">
								<input type="text" class="form-control" name="login" placeholder="Nick" required>
							</div>
						</div><br>
						<div class="form-group">
							<div class="col-lg-10">
								<input type="password" class="form-control" name="password" placeholder="Password" required>
							</div>
						</div><br>
						<div class="form-group">
							<div class="col-lg-10">
								<input type="email" class="form-control" name="email" placeholder="E-mail" required>
							</div>
						</div>
						<div class="form-group">
							<div class="col-lg-10 col-lg-offset-2"><br>
								<button class="btn btn-success hvr-grow">[ REGISTER ]</button><br><br><a href="../login/login.php" class="btn btn-success hvr-grow">[ BACK ]</a><br><br>
							</div>
						 </div>

</form>
</div>
</div>
	</div>
</div>