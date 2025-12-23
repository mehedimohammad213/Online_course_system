<!DOCTYPE html>
<html>
<head>
    <title>Student Registration</title>
</head>
<body>

<h2>Student Registration</h2>

<form method="post">
    Name: <br>
    <input type="text" name="name" required><br><br>

    Email: <br>
    <input type="email" name="email" required><br><br>

    Password: <br>
    <input type="password" name="password" required><br><br>

    <input type="submit" name="register" value="Register">
</form>

<?php
include("../config/db.php");

if (isset($_POST['register'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "INSERT INTO users (name, email, password, role, status)
            VALUES ('$name', '$email', '$password', 'student', 'pending')";

    if (mysqli_query($conn, $sql)) {
        echo "Registration successful. Wait for admin approval.";
    } else {
        echo "Error";
    }
}
?>

</body>
</html>
