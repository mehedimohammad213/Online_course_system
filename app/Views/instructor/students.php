<!DOCTYPE html>
<html>
<head>
    <title>Approved Students</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/assets/css/style.css">
</head>
<body>
    <div class="container">
        <h2>Approved Students</h2>

        <?php if (empty($students)): ?>
            <p>No approved students found for this course.</p>
        <?php else: ?>
            <table>
                <tr><th>Name</th><th>Email</th></tr>
                <?php foreach ($students as $student): ?>
                    <tr>
                        <td><?php echo $student['name']; ?></td>
                        <td><?php echo $student['email']; ?></td>
                    </tr>
                <?php endforeach; ?>
            </table>
        <?php endif; ?>

        <br>
        <a href="/instructor/assigned_courses">Back to Assigned Courses</a>
    </div>
</body>
</html>
