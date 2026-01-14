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
    $title = mysqli_real_escape_string($conn, trim($_POST['title']));
    $file_name = $_FILES['file']['name'];
    $file_size = $_FILES['file']['size'];
    $tmp = $_FILES['file']['tmp_name'];

    $allowed_extensions = ['pdf', 'doc', 'docx', 'txt', 'jpg', 'jpeg', 'png'];
    $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));

    if (empty($title)) {
        echo "<div class='error'>Title is required.</div>";
    } elseif (!$file_name) {
        echo "<div class='error'>Please select a file.</div>";
    } elseif (!in_array($file_ext, $allowed_extensions)) {
        echo "<div class='error'>Invalid file type. Allowed: " . implode(', ', $allowed_extensions) . "</div>";
    } elseif ($file_size > 10 * 1024 * 1024) { // 10 MB
        echo "<div class='error'>File size exceeds 10MB limit.</div>";
    } else {
        $new_file_name = time() . "_" . $file_name; // Unique filename
        if (move_uploaded_file($tmp, "../uploads/" . $new_file_name)) {
            mysqli_query($conn, "INSERT INTO materials (course_id, title, file_path)
                                 VALUES ($course_id, '$title', '$new_file_name')");
            echo "<div class='success'>Material Uploaded Successfully</div>";
        } else {
            echo "<div class='error'>Error uploading file.</div>";
        }
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Upload Course Material</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
    <div class="container">
        <h2>Upload Course Material</h2>

        <form method="post" enctype="multipart/form-data">
            Title: <br>
            <input type="text" name="title" required><br><br>

            File: <br>
            <input type="file" name="file" required><br><br>

            <input type="submit" name="upload" value="Upload">
        </form>

        <br>
        <a href="assigned_courses.php">Back to Assigned Courses</a>
    </div>
</body>
</html>
