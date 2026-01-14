<!DOCTYPE html>
<html>
<head>
    <title>Instructor Registration</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/assets/css/style.css">
</head>
<body>
    <div class="container">
        <h2>Instructor Registration</h2>

        <?php if (isset($success)): ?>
            <div class="success"><?php echo $success; ?></div>
        <?php endif; ?>

        <?php if (isset($error)): ?>
            <div class="error"><?php echo $error; ?></div>
        <?php endif; ?>

        <?php if (isset($errors)): ?>
            <?php foreach ($errors as $err): ?>
                <div class="error"><?php echo $err; ?></div><br>
            <?php endforeach; ?>
        <?php endif; ?>

        <form id="instructorRegistrationForm" method="post" action="/auth/instructor_register">
            Name:<br>
            <input type="text" name="name" required pattern="[A-Za-z\s]+" title="Name should only contain letters and spaces"><br><br>

            Email:<br>
            <input type="email" name="email" required><br><br>

            Password:<br>
            <input type="password" name="password" required pattern=".{8,}" title="Password must be at least 8 characters long"><br><br>

            <input type="submit" name="register" value="Register">
        </form>

        <?php if (isset($success)): ?>
            <script>
                document.getElementById('instructorRegistrationForm').reset();
            </script>
        <?php endif; ?>

        <br>
        <a href="/">Back to Home</a>
    </div>
</body>
</html>
