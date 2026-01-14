<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/assets/css/style.css">
</head>
<body>
    <div class="container">
        <h2>Login</h2>

        <?php if (isset($error)): ?>
            <div class="error"><?php echo $error; ?></div>
        <?php endif; ?>

        <form method="post" action="/auth/login">
            Email: <br>
            <input type="email" name="email" required><br><br>

            Password: <br>
            <input type="password" name="password" required><br><br>

            <input type="submit" name="login" value="Login">
        </form>

        <br>
        <a href="/">Back to Home</a>
    </div>
</body>
</html>
