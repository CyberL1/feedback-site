<?php

$host = $_POST['host'];
$username = $_POST['username'];
$password = $_POST['password'];
$name =  $_POST['name'];

file_put_contents('../../inc/connect.php', "<?php

\$dbhost = \"$host\";
\$dbuser = \"$username\";
\$dbpass = \"$password\";
\$dbbase = \"$name\";

\$connect = new mysqli(\$dbhost, \$dbuser, \$dbpass, \$dbbase);

?>");

require("../../inc/connect.php");

// Read in entire file
$lines = file('setup.sql');
// Loop through each line
foreach ($lines as $line) {
// Skip it if it's a comment
    if (substr($line, 0, 2) == '--' || $line == '')
        continue;

// Add this line to the current segment
    $templine .= $line;
// If it has a semicolon at the end, it's the end of the query
    if (substr(trim($line), -1, 1) == ';') {
        // Perform the query
        mysqli_query($connect, $templine);
        // Reset temp variable to empty
        $templine = '';
    }
}

Header("Location: ../super-admin");