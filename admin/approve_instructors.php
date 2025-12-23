<?php
session_start();
include("../config/db.php");

if ($_SESSION['role'] != 'admin') {
    header("Location: ../auth/login.php");
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Approve Instructors</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
    <div class="container">
        <h2>Approve Instructors</h2>

        <?php
        $result = mysqli_query($conn,
            "SELECT * FROM users WHERE role='instructor' AND status='pending' ORDER BY created_at DESC"
        );

        if (mysqli_num_rows($result) == 0) {
            echo "<p>No pending instructor requests.</p>";
        } else {
            echo "<table>";
            echo "<tr><th>Name</th><th>Email</th><th>Action</th></tr>";
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>".$row['name']."</td>";
                echo "<td>".$row['email']."</td>";
                echo "<td>";
                echo "<a href='approve_instructor_action.php?id=".$row['user_id']."'>Approve</a> | ";
                echo "<a href='reject_instructor.php?id=".$row['user_id']."'>Reject</a>";
                echo "</td>";
                echo "</tr>";
            }
            echo "</table>";
        }
        ?>

        <br>
        <a href="dashboard.php">Back to Dashboard</a>
    </div>
</body>
</html>
