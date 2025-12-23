<!DOCTYPE html>
<html>
<head>
    <title>Student Registration</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
    <div class="container">
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
                echo "<div class='success'>Registration successful. Wait for admin approval.</div>";
            } else {
                echo "<div class='error'>Error: " . mysqli_error($conn) . "</div>";
            }
        }
        ?>

        <br>
        <a href="../index.php">Back to Home</a>
    </div>
</body>
</html>
