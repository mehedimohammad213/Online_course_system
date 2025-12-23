<?php
session_start();
include("../config/db.php");

if ($_SESSION['role'] != 'admin') {
    header("Location: ../auth/login.php");
}
?>

<h2>Add Course</h2>

<form method="post">
    Course Title:<br>
    <input type="text" name="title" required><br><br>

    Description:<br>
    <textarea name="description" required></textarea><br><br>

    <input type="submit" name="add" value="Add Course">
</form>

<?php
if (isset($_POST['add'])) {
    $title = $_POST['title'];
    $description = $_POST['description'];

    mysqli_query($conn,
        "INSERT INTO courses (course_title, description, status)
         VALUES ('$title', '$description', 'active')"
    );

    echo "Course Added Successfully";
}
?>
