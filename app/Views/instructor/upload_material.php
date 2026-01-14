<!DOCTYPE html>
<html>
<head>
    <title>Upload Course Material</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/assets/css/style.css">
</head>
<body>
    <div class="container">
        <h2>Upload Course Material</h2>

        <?php if (isset($success)): ?>
            <div class="success"><?php echo $success; ?></div>
        <?php endif; ?>
        <?php if (isset($error)): ?>
            <div class="error"><?php echo $error; ?></div>
        <?php endif; ?>

        <form method="post" action="/instructor/upload_material/<?php echo $course_id; ?>" enctype="multipart/form-data">
            Title: <br>
            <input type="text" name="title" required><br><br>

            File: <br>
            <input type="file" name="file" required><br><br>

            <input type="submit" name="upload" value="Upload">
        </form>

        <br>
        <a href="/instructor/assigned_courses">Back to Assigned Courses</a>
    </div>
</body>
</html>
