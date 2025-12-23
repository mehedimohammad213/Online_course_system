<?php
session_start();
include("../config/db.php");

if ($_SESSION['role'] != 'admin') {
    header("Location: ../auth/login.php");
    exit();
}
?>

<h2>All Instructors</h2>

<?php
$result = mysqli_query($conn, "SELECT user_id, name, email, status FROM users WHERE role='instructor' ORDER BY name");

if (mysqli_num_rows($result) == 0) {
    echo "No instructors found.";
} else {
    echo "<table border='1' cellpadding='10'>";
    echo "<tr><th>Name</th><th>Email</th><th>Status</th></tr>";

    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>".$row['name']."</td>";
        echo "<td>".$row['email']."</td>";
        echo "<td>".ucfirst($row['status'])."</td>";
        echo "</tr>";
    }

    echo "</table>";
}
?>

<br>
<a href="dashboard.php">Back to Dashboard</a>
