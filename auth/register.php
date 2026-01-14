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
            <input type="text" name="name" required pattern="[A-Za-z\s]+" title="Name should only contain letters and spaces"><br><br>

            Email: <br>
            <input type="email" name="email" required><br><br>

            Password: <br>
            <input type="password" name="password" required pattern=".{8,}" title="Password must be at least 8 characters long"><br><br>

            <input type="submit" name="register" value="Register">
        </form>

        <?php
        include("../config/db.php");

        if (isset($_POST['register'])) {
            $name = mysqli_real_escape_string($conn, trim($_POST['name']));
            $email = mysqli_real_escape_string($conn, trim($_POST['email']));
            $password = $_POST['password'];

            // Server-side Validation
            $errors = [];

            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $errors[] = "Invalid email format.";
            }

            if (strlen($password) < 8) {
                $errors[] = "Password must be at least 8 characters long.";
            }

            // Check if email already exists
            $check_email = mysqli_query($conn, "SELECT email FROM users WHERE email='$email'");
            if (mysqli_num_rows($check_email) > 0) {
                $errors[] = "Email already registered.";
            }

            if (empty($errors)) {
                $sql = "INSERT INTO users (name, email, password, role, status)
                        VALUES ('$name', '$email', '$password', 'student', 'pending')";

                if (mysqli_query($conn, $sql)) {
                    echo "<div class='success'>Registration successful. Wait for admin approval.</div>";
                } else {
                    echo "<div class='error'>Error: " . mysqli_error($conn) . "</div>";
                }
            } else {
                foreach ($errors as $error) {
                    echo "<div class='error'>$error</div><br>";
                }
            }
        }
        ?>

        <br>
        <a href="../index.php">Back to Home</a>
    </div>
</body>
</html>
