<?php
session_start();
include("../config/db.php");

if ($_SESSION['role'] != 'admin') {
    header("Location: ../auth/login.php");
}
?>

<h2>Assign Instructor</h2>

<form method="post">
    Course ID: <br>
    <input type="number" name="course_id"><br><br>

    Instructor ID: <br>
    <input type="number" name="instructor_id"><br><br>

    <input type="submit" name="assign" value="Assign">
</form>

<?php
if (isset($_POST['assign'])) {
    $course_id = $_POST['course_id'];
    $instructor_id = $_POST['instructor_id'];

    mysqli_query($conn, "UPDATE courses 
                         SET instructor_id=$instructor_id 
                         WHERE course_id=$course_id");

    echo "Instructor Assigned Successfully";
}
?>
