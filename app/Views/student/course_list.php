<!DOCTYPE html>
<html>
<head>
    <title>Available Courses</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/assets/css/style.css">
</head>
<body>
    <div class="container">
        <h2>Available Courses</h2>

        <?php if (empty($courses)): ?>
            <p>No courses available at the moment.</p>
        <?php else: ?>
            <?php foreach ($courses as $course): ?>
                <div style="margin: 20px 0; padding: 15px; background: #f9f9f9; border-radius: 5px;">
                    <h3><?php echo $course['course_title']; ?></h3>
                    <p><?php echo $course['description']; ?></p>
                    <a href="/student/enroll/<?php echo $course['course_id']; ?>">Enroll</a>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>

        <br>
        <a href="/student/dashboard">Back to Dashboard</a>
    </div>
</body>
</html>
