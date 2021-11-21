<?php /*

$serverName = "localhost";
$dbUsername = "root";
$dbPassword = "";
$dbName = "project_01";

$conn = mysqli_connect($serverName, $dbUsername, $dbPassword, $dbName);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
*/

?>
<?php

define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'project_01');
 

$conn = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
 

if($conn === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}

?> 