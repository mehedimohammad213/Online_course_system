<?php
session_start();
include("../config/db.php");

if ($_SESSION['role'] != 'student') {
    header("Location: ../auth/login.php");
    exit();
}

$student_id = $_SESSION['user_id'];
$course_id = $_GET['id'];

// Check if already enrolled
$check = mysqli_query($conn,
    "SELECT * FROM enrollment_requests WHERE student_id=$student_id AND course_id=$course_id"
);

if (mysqli_num_rows($check) > 0) {
    $message = "You have already sent an enrollment request for this course.";
    $class = "error";
} else {
    if (mysqli_query($conn,
        "INSERT INTO enrollment_requests (student_id, course_id, request_status)
         VALUES ($student_id, $course_id, 'pending')"
    )) {
        $message = "Enrollment request sent successfully.";
        $class = "success";
    } else {
        $message = "Error: " . mysqli_error($conn);
        $class = "error";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Enrollment</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
    <div class="container">
        <div class="<?php echo $class; ?>"><?php echo $message; ?></div>
        <br>
        <a href="course_list.php">Back to Courses</a>
    </div>
</body>
</html>
