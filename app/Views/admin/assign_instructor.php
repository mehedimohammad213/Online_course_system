<!DOCTYPE html>
<html>
<head>
    <title>Assign Instructor</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/assets/css/style.css">
</head>
<body>
    <div class="container">
        <h2>Assign Instructor</h2>

        <?php if (isset($success)): ?>
            <div class="success"><?php echo $success; ?></div>
        <?php endif; ?>
        <?php if (isset($error)): ?>
            <div class="error"><?php echo $error; ?></div>
        <?php endif; ?>

        <form method="post" action="/admin/assign_instructor">
            Course: <br>
            <select name="course_id" required>
                <option value="">Select Course</option>
                <?php foreach ($courses as $course): ?>
                    <option value="<?php echo $course['course_id']; ?>"><?php echo $course['course_title']; ?></option>
                <?php endforeach; ?>
            </select><br><br>

            Instructor: <br>
            <select name="instructor_id" required>
                <option value="">Select Instructor</option>
                <?php foreach ($instructors as $instructor): ?>
                    <option value="<?php echo $instructor['user_id']; ?>"><?php echo $instructor['name']; ?></option>
                <?php endforeach; ?>
            </select><br><br>

            <input type="submit" name="assign" value="Assign Instructor">
        </form>

        <br>
        <a href="/admin/dashboard">Back to Dashboard</a>
    </div>
</body>
</html>
