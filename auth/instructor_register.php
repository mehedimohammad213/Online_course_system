<!DOCTYPE html>
<html>
<head>
    <title>Instructor Registration</title>
</head>
<body>

<h2>Instructor Registration</h2>

<form method="post">
    Name:<br>
    <input type="text" name="name" required><br><br>

    Email:<br>
    <input type="email" name="email" required><br><br>

    Password:<br>
    <input type="password" name="password" required><br><br>

    <input type="submit" name="register" value="Register">
</form>

<?php
include("../config/db.php");

if (isset($_POST['register'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    mysqli_query($conn,
        "INSERT INTO users (name, email, password, role, status)
         VALUES ('$name', '$email', '$password', 'instructor', 'pending')"
    );

    echo "Registration successful. Wait for admin approval.";
}
?>

<a href="../index.php">Back to Home</a>

</body>
</html>
