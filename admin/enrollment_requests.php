<?php
session_start();
include("../config/db.php");

if ($_SESSION['role'] != 'admin') {
    header("Location: ../auth/login.php");
}
?>

<h2>Enrollment Requests</h2>

<?php
$sql = "SELECT er.request_id, u.name, c.course_title
        FROM enrollment_requests er
        JOIN users u ON er.student_id = u.user_id
        JOIN courses c ON er.course_id = c.course_id
        WHERE er.request_status = 'pending'";

$result = mysqli_query($conn, $sql);

while ($row = mysqli_fetch_assoc($result)) {
    echo $row['name']." applied for ".$row['course_title'];
    echo " <a href='approve_enrollment.php?id=".$row['request_id']."'>Approve</a> | ";
    echo "<a href='reject_enrollment.php?id=".$row['request_id']."'>Reject</a>";
    echo "<br><br>";
}
?>
