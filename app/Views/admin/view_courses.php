<!DOCTYPE html>
<html>
<head>
    <title>All Courses</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/assets/css/style.css">
</head>
<body>
    <div class="container">
        <h2>All Courses</h2>

        <?php if (empty($courses)): ?>
            <p>No courses found.</p>
        <?php else: ?>
            <?php foreach ($courses as $course): ?>
                <div style="margin: 20px 0; padding: 15px; background: #f9f9f9; border-radius: 5px;">
                    <h3><?php echo $course['course_title']; ?></h3>
                    <p><?php echo $course['description']; ?></p>
                    <div class="dashboard-links">
                        <a href="/admin/update_course/<?php echo $course['course_id']; ?>">Update</a>
                        <a href="/admin/delete_course/<?php echo $course['course_id']; ?>" onclick="return confirm('Are you sure you want to delete this course?')">Delete</a>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>

        <br>
        <a href="/admin/dashboard">Back to Dashboard</a>
    </div>
</body>
</html>
