<!DOCTYPE html>
<html>
<head>
    <title>My Assigned Courses</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/assets/css/style.css">
</head>
<body>
    <div class="container">
        <h2>My Assigned Courses</h2>

        <?php if (empty($courses)): ?>
            <p>No courses assigned yet.</p>
        <?php else: ?>
            <?php foreach ($courses as $course): ?>
                <div style="margin: 20px 0; padding: 15px; background: #f9f9f9; border-radius: 5px;">
                    <h3><?php echo $course['course_title']; ?></h3>
                    <p><?php echo $course['description']; ?></p>
                    <div class="dashboard-links">
                        <a href="/instructor/students/<?php echo $course['course_id']; ?>">View Students</a>
                        <a href="/instructor/upload_material/<?php echo $course['course_id']; ?>">Upload Material</a>
                        <a href="/instructor/upload_notice/<?php echo $course['course_id']; ?>">Upload Notice</a>
                        <a href="/instructor/update_course/<?php echo $course['course_id']; ?>">Update Course</a>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>

        <br>
        <a href="/instructor/dashboard">Back to Dashboard</a>
    </div>
</body>
</html>
