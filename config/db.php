<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "online_course_db";

$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
    die("Database connection failed");
}
?>
