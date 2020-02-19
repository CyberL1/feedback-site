<?php include ("../../../inc/header.php"); ?>
<?php
require("../../inc/header.php")

session_start();
if(!isset($_SESSION['login'])) { // checks if we are logined
header('Location: ../../login/login.php');
exit();
}
?>
<div class="container">
<?php include("../../../inc/menu-login.php"); ?><center>
	<div>
		<br><br>
		<div>
			<div>
				<div>
					<div><h2>Submit a new suggestion</h2></div>
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