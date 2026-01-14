<!DOCTYPE html>
<html>
<head>
    <title>Update Course</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/assets/css/style.css">
</head>
<body>
    <div class="container">
        <h2>Update Course</h2>

        <?php if (isset($success)): ?>
            <div class="success"><?php echo $success; ?></div>
        <?php endif; ?>
        <?php if (isset($error)): ?>
            <div class="error"><?php echo $error; ?></div>
        <?php endif; ?>

        <form method="post" action="/instructor/update_course/<?php echo $course['course_id']; ?>">
            Course Title:<br>
            <input type="text" name="title" value="<?php echo htmlspecialchars($course['course_title']); ?>" required><br><br>

            Description:<br>
            <textarea name="description" rows="5" required><?php echo htmlspecialchars($course['description']); ?></textarea><br><br>

            <input type="submit" name="update" value="Update Course">
        </form>

        <br>
        <a href="/instructor/assigned_courses">Back to Assigned Courses</a>
    </div>
</body>
</html>
