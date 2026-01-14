<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
    <div class="container">
        <h2>Login</h2>

        <form method="post" action="">
            Email: <br>
            <input type="email" name="email" required><br><br>

            Password: <br>
            <input type="password" name="password" required><br><br>

            <input type="submit" name="login" value="Login">
        </form>

<?php
include("../config/db.php");

if (isset($_POST['login'])) {
    $email = mysqli_real_escape_string($conn, trim($_POST['email']));
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    $sql = "SELECT * FROM users WHERE email='$email' AND password='$password' AND status='approved'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
        session_start();
        $_SESSION['role'] = $row['role'];
        $_SESSION['user_id'] = $row['user_id'];


        if ($row['role'] == 'admin') {
            header("Location: ../admin/dashboard.php");
        } elseif ($row['role'] == 'student') {
            header("Location: ../student/dashboard.php");
        } else {
            header("Location: ../instructor/dashboard.php");
        }
    } else {
        echo "<div class='error'>Invalid login</div>";
    }
}
?>

        <br>
        <a href="../index.php">Back to Home</a>
    </div>
</body>
</html>
