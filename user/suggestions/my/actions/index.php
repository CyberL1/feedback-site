<?php include("../../../../inc/header.php") ?>
<?php
session_start();
if (!isset($_SESSION['login'])) { // checks if we are logined
    header('Location: ../../../../login/login.php');
    exit();
}
?>
<div class="container">
<?php
require("../../../../inc/connect.php");
$nr = $_GET['nr'];
?>
<?php
if ($query = mysqli_query($connect, "SELECT * FROM `suggestions` WHERE `nr`='$nr'")) {
   while ($modify = mysqli_fetch_assoc ($query)) {
      $nr = $modify['nr'];
      if($modify['nick'] !== $_SESSION['login']) {
         echo '<p>You cannot modify other users suggestions</p>';
         mysqli_close($connect);
         exit();
      } else {
         include("../../../../inc/menu-login.php");
         echo "<div>";
   echo "<div>";
      echo "<div>";
         echo "<div>";
            echo "<h1 class='text-center'>Manage suggestion #$nr</h1><hr>";
            echo "<p class='text-center'><b><a class='hvr-grow' href='edit/edit.php?nr=$nr'>[ EDIT SUGGESTION ]</a></b></p>";
            echo "<p class='text-center'><b><a class='hvr-grow' href='delete.php?nr=$nr'>[ DELETE SUGGESTION ]</a></b></p>";
            echo "<p class='text-center'><b><a class='hvr-grow' href='../my.php'>[ BACK ]</a></b></p>";
            echo "</div>";
            echo "</div>";
         echo "</div>";
   echo "</div>";
echo "</div>";
echo "</body>";
echo "<html>";
      }
   }
}

mysqli_close($connect);
?>