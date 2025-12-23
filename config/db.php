<?php
$servername = "127.0.0.1";
$username = "root";
$password = "";
$dbname = "online_course_db";
$port = 3306;

$conn = mysqli_connect($servername, $username, $password, $dbname, $port);

if (!$conn) {
    die("Database connection failed: " . mysqli_connect_error());
}
?>
