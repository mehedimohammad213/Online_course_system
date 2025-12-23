<?php
session_start();
include("../config/db.php");

if ($_SESSION['role'] != 'instructor') {
    header("Location: ../auth/login.php");
    exit();
}

$instructor_id = $_SESSION['user_id'];
$course_id = $_GET['id'];

// Check if instructor is assigned to this course
$check = mysqli_query($conn,
    "SELECT * FROM courses WHERE course_id=$course_id AND instructor_id=$instructor_id"
);

if (mysqli_num_rows($check) == 0) {
    echo "You are not assigned to this course.";
    exit();
}

if (isset($_POST['upload'])) {
    $title = $_POST['title'];
    $content = $_POST['content'];

    mysqli_query($conn,
        "INSERT INTO notices (course_id, title, content)
         VALUES ($course_id, '$title', '$content')"
    );

    echo "Notice Uploaded Successfully<br><br>";
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Upload Notice</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
    <div class="container">
        <h2>Upload Course Notice</h2>

        <form method="post">
            Title: <br>
            <input type="text" name="title" required><br><br>

            Content: <br>
            <textarea name="content" rows="5" required></textarea><br><br>

            <input type="submit" name="upload" value="Upload Notice">
        </form>

        <br>
        <a href="assigned_courses.php">Back to Assigned Courses</a>
    </div>
</body>
</html>
