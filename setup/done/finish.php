<?php

// List of name of files inside all setup directories
$database = glob('../database/*');
$superadmin = glob('../super-admin/*');
$done = glob('../done/*');
$welcome = glob('../*');

foreach($database as $file) if(is_file($file)) unlink($file); rmdir('../database'); // Delete all files in database directory then delete the dir itself
foreach($superadmin as $file) if(is_file($file)) unlink($file); rmdir('../super-admin'); // Delete all files in super-admin directory then delete the dir itself
foreach($done as $file) if(is_file($file)) unlink($file); rmdir('../done'); // Delete all files in done directory then delete the dir itself
foreach($welcome as $file) if(is_file($file)) unlink($file); rmdir('..'); // Delete all files in main setup directory then delete the dir itself

Header("Location: /");
?>
