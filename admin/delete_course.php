<?php
session_start();
include("../config/db.php");

if ($_SESSION['role'] != 'admin') {
    header("Location: ../auth/login.php");
    exit();
}

$id = $_GET['id'];
mysqli_query($conn, "DELETE FROM courses WHERE course_id=$id");

echo "Course Deleted";
?>
