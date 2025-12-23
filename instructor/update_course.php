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

if (isset($_POST['update'])) {
    $title = $_POST['title'];
    $desc = $_POST['description'];

    mysqli_query($conn,
        "UPDATE courses SET course_title='$title', description='$desc'
         WHERE course_id=$course_id AND instructor_id=$instructor_id"
    );

    echo "Course Updated Successfully<br><br>";
}

// Get current course data
$course = mysqli_fetch_assoc(mysqli_query($conn,
    "SELECT * FROM courses WHERE course_id=$course_id"
));
?>

<h2>Update Course</h2>

<form method="post">
    Course Title:<br>
    <input type="text" name="title" value="<?php echo htmlspecialchars($course['course_title']); ?>" required><br><br>

    Description:<br>
    <textarea name="description" required><?php echo htmlspecialchars($course['description']); ?></textarea><br><br>

    <input type="submit" name="update" value="Update Course">
</form>

<br>
<a href="assigned_courses.php">Back to Assigned Courses</a>
