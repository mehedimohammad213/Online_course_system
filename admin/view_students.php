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
    <title>All Students</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
    <div class="container">
        <h2>All Students</h2>

        <?php
        $result = mysqli_query($conn, "SELECT user_id, name, email, status FROM users WHERE role='student' ORDER BY name");

        if (mysqli_num_rows($result) == 0) {
            echo "<p>No students found.</p>";
        } else {
            echo "<table>";
            echo "<tr><th>Name</th><th>Email</th><th>Status</th></tr>";

            while ($row = mysqli_fetch_assoc($result)) {
                $status_class = $row['status'] == 'approved' ? 'success' :
                               ($row['status'] == 'rejected' ? 'error' : '');
                echo "<tr>";
                echo "<td>".$row['name']."</td>";
                echo "<td>".$row['email']."</td>";
                echo "<td><span class='$status_class'>".ucfirst($row['status'])."</span></td>";
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
