<?php
session_start();
include("../config/db.php");

if ($_SESSION['role'] != 'admin') {
    header("Location: ../auth/login.php");
}
?>

<h2>Pending Student Requests</h2>

<?php
$result = mysqli_query($conn, "SELECT * FROM users WHERE role='student' AND status='pending'");

while ($row = mysqli_fetch_assoc($result)) {
    echo $row['name'] . " - " . $row['email'];
    echo " <a href='approve.php?id=".$row['user_id']."'>Approve</a> | ";
    echo "<a href='reject_student.php?id=".$row['user_id']."'>Reject</a><br><br>";
}
?>
