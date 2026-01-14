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
    <title>Add Course</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
    <div class="container">
        <h2>Add Course</h2>

        <form method="post">
            Course Title:<br>
            <input type="text" name="title" required><br><br>

            Description:<br>
            <textarea name="description" rows="5" required></textarea><br><br>

            <input type="submit" name="add" value="Add Course">
        </form>

        <?php
        if (isset($_POST['add'])) {
            $title = mysqli_real_escape_string($conn, trim($_POST['title']));
            $description = mysqli_real_escape_string($conn, trim($_POST['description']));

            if (empty($title) || empty($description)) {
                echo "<div class='error'>All fields are required.</div>";
            } else {
                if (mysqli_query($conn,
                    "INSERT INTO courses (course_title, description, status)
                     VALUES ('$title', '$description', 'active')"
                )) {
                    echo "<div class='success'>Course Added Successfully</div>";
                } else {
                    echo "<div class='error'>Error: " . mysqli_error($conn) . "</div>";
                }
            }
        }
        ?>

        <br>
        <a href="dashboard.php">Back to Dashboard</a>
    </div>
</body>
</html>
