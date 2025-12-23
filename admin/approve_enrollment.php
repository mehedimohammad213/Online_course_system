<?php
session_start();
include("../config/db.php");

if ($_SESSION['role'] != 'admin') {
    header("Location: ../auth/login.php");
    exit();
}

$id = $_GET['id'];

mysqli_query($conn, "UPDATE enrollment_requests
                     SET request_status='approved'
                     WHERE request_id=$id");

header("Location: enrollment_requests.php");
?>
