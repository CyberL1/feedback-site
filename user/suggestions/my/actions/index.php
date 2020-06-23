<?php
require("../../../../inc/connect.php");
include("../../../../inc/header.php");
?>
<?php
session_start();
if (!isset($_SESSION['login'])) { // checks if we are logined
    header('Location: ../../../login');
    exit();
}

$login = $_SESSION['login'];

if($admincheck = mysqli_query ($connect, "SELECT * FROM `users` WHERE `admin` = '2' AND `login` = '$login'")) {
   while($isadmin = mysqli_fetch_assoc($admincheck)) {
      include("../../../../inc/menu-superadmin.php");
   }
}

mysqli_query($connect, "SELECT * FROM `users`");
if($admincheck = mysqli_query ($connect, "SELECT * FROM `users` WHERE `admin` = '1' AND `login`='$login'")) {
   while($isadmin = mysqli_fetch_assoc($admincheck)) {
      include("../../../../inc/menu-admin.php");
   }
}
if($admincheck = mysqli_query ($connect, "SELECT * FROM `users` WHERE `admin` = '0' AND `login`='$login'")) {
   while($isadmin = mysqli_fetch_assoc($admincheck)) {
    include("../../../../inc/menu-login.php");
   }
}
?>
<div class="container">
<?php $nr = $_GET['nr']; ?>
<?php
if ($query = mysqli_query($connect, "SELECT * FROM `suggestions` WHERE `nr`='$nr'")) {
   while ($modify = mysqli_fetch_assoc ($query)) {
      $nr = $modify['nr'];
      if($modify['nick'] !== $_SESSION['login']) {
         echo '<p>You cannot modify other users suggestions</p>';
         mysqli_close($connect);
         exit();
      } else {
         echo "<div>";
   echo "<div>";
      echo "<div>";
         echo "<div>";
            echo "<h1 class='text-center'>Manage suggestion #$nr</h1><hr>";
            echo "<p class='text-center'><b><a class='hvr-grow' href='edit?nr=$nr'>[ EDIT SUGGESTION ]</a></b></p>";
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