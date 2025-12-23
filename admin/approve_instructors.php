<?php
session_start();
include("../config/db.php");

if ($_SESSION['role'] != 'admin') {
    header("Location: ../auth/login.php");
}
?>

<h2>Approve Instructors</h2>

<?php
$result = mysqli_query($conn,
    "SELECT * FROM users WHERE role='instructor' AND status='pending'"
);

while ($row = mysqli_fetch_assoc($result)) {
    echo $row['name']." - ".$row['email'];
    echo " <a href='approve_instructor_action.php?id=".$row['user_id']."'>Approve</a> | ";
    echo "<a href='reject_instructor.php?id=".$row['user_id']."'>Reject</a><br><br>";
}
?>
