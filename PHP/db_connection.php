<!-- db_connection.php -->
<?php
// Database connection parameters
$servername = "mysql.yourservername.com";
$username = "your mysql username";
$password = "your mysql password";
$dbname = "your database name";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>
