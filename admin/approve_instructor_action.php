<?php
session_start();
include("../config/db.php");

if ($_SESSION['role'] != 'admin') {
    header("Location: ../auth/login.php");
    exit();
}

$id = $_GET['id'];
mysqli_query($conn,
    "UPDATE users SET status='approved' WHERE user_id=$id"
);

header("Location: approve_instructors.php");
?>
