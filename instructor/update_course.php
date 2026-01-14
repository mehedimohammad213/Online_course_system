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
    echo "<div class='error'>You are not assigned to this course.</div>";
    exit();
}

if (isset($_POST['update'])) {
    $title = mysqli_real_escape_string($conn, trim($_POST['title']));
    $desc = mysqli_real_escape_string($conn, trim($_POST['description']));

    if (empty($title) || empty($desc)) {
        echo "<div class='error'>All fields are required.</div><br>";
    } else {
        if (mysqli_query($conn,
            "UPDATE courses SET course_title='$title', description='$desc'
             WHERE course_id=$course_id AND instructor_id=$instructor_id"
        )) {
            echo "<div class='success'>Course Updated Successfully</div><br>";
        } else {
            echo "<div class='error'>Error: " . mysqli_error($conn) . "</div><br>";
        }
    }
}

// Get current course data
$course = mysqli_fetch_assoc(mysqli_query($conn,
    "SELECT * FROM courses WHERE course_id=$course_id"
));
?>
<!DOCTYPE html>
<html>
<head>
    <title>Update Course</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
    <div class="container">
        <h2>Update Course</h2>

        <form method="post">
            Course Title:<br>
            <input type="text" name="title" value="<?php echo htmlspecialchars($course['course_title']); ?>" required><br><br>

            Description:<br>
            <textarea name="description" rows="5" required><?php echo htmlspecialchars($course['description']); ?></textarea><br><br>

            <input type="submit" name="update" value="Update Course">
        </form>

        <br>
        <a href="assigned_courses.php">Back to Assigned Courses</a>
    </div>
</body>
</html>
