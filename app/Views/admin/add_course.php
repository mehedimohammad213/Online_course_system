<!DOCTYPE html>
<html>
<head>
    <title>Add Course</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/assets/css/style.css">
</head>
<body>
    <div class="container">
        <h2>Add Course</h2>

        <?php if (isset($success)): ?>
            <div class="success"><?php echo $success; ?></div>
        <?php endif; ?>
        <?php if (isset($error)): ?>
            <div class="error"><?php echo $error; ?></div>
        <?php endif; ?>

        <form method="post" action="/admin/add_course">
            Course Title:<br>
            <input type="text" name="title" required><br><br>

            Description:<br>
            <textarea name="description" rows="5" required></textarea><br><br>

            <input type="submit" name="add" value="Add Course">
        </form>

        <br>
        <a href="/admin/dashboard">Back to Dashboard</a>
    </div>
</body>
</html>
