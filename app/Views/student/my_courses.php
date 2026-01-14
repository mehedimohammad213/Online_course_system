<!DOCTYPE html>
<html>
<head>
    <title>My Courses</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/assets/css/style.css">
</head>
<body>
    <div class="container">
        <h2>My Courses</h2>

        <?php if (empty($courses)): ?>
            <p>You haven't enrolled in any courses yet.</p>
        <?php else: ?>
            <table>
                <tr><th>Course Title</th><th>Status</th></tr>
                <?php foreach ($courses as $course): ?>
                    <?php 
                        $status_class = $course['request_status'] == 'approved' ? 'success' :
                                       ($course['request_status'] == 'rejected' ? 'error' : '');
                    ?>
                    <tr>
                        <td><?php echo $course['course_title']; ?></td>
                        <td><span class="<?php echo $status_class; ?>"><?php echo ucfirst($course['request_status']); ?></span></td>
                    </tr>
                <?php endforeach; ?>
            </table>
        <?php endif; ?>

        <br>
        <a href="/student/dashboard">Back to Dashboard</a>
    </div>
</body>
</html>
