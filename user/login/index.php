<?php require("../../inc/header.php") ?>
<div class="container">
<?php include("../../inc/menu.php") ?>
	<div class="row">
		<hr><br><br>

            <div class="text-center">
               <div>
                  <h1>LOGIN</h1>
               </div>
               <div>
                  <form action="action.php" method="POST" class="form-horizontal" id="loginForm">

<div class="input-group">
  <input class="form-control" name="login" type="text" placeholder="Login" required>
</div><br>
  <input class="form-control" type="password" name="password" placeholder="Password" required>
</div><br>
<button type="submit" class="btn btn-success hvr-grow">[ LOGIN ]</button><br><br><a href="../register" class="btn btn-default hvr-grow">[ REGISTER ]</a><br><br><a href="../../index.php" class="btn btn-default hvr-grow">[ BACK ]</a>

</form>
</div>
</div>
</div>
<html>
