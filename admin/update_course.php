<?php
session_start();
include("../config/db.php");

if ($_SESSION['role'] != 'admin') {
    header("Location: ../auth/login.php");
    exit();
}

$id = $_GET['id'];

if (isset($_POST['update'])) {
    $title = $_POST['title'];
    $desc = $_POST['description'];

    mysqli_query($conn,
        "UPDATE courses SET course_title='$title', description='$desc'
         WHERE course_id=$id"
    );
    echo "Course Updated";
}
?>

<form method="post">
    New Title:<br>
    <input type="text" name="title"><br><br>

    New Description:<br>
    <textarea name="description"></textarea><br><br>

    <input type="submit" name="update" value="Update">
</form>
