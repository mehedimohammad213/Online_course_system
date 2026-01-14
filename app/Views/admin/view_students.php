<!DOCTYPE html>
<html>
<head>
    <title>All Students</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/assets/css/style.css">
</head>
<body>
    <div class="container">
        <h2>All Students</h2>

        <?php if (empty($students)): ?>
            <p>No students found.</p>
        <?php else: ?>
            <table>
                <tr><th>Name</th><th>Email</th><th>Status</th></tr>
                <?php foreach ($students as $student): ?>
                    <?php 
                        $status_class = $student['status'] == 'approved' ? 'success' :
                                       ($student['status'] == 'rejected' ? 'error' : '');
                    ?>
                    <tr>
                        <td><?php echo $student['name']; ?></td>
                        <td><?php echo $student['email']; ?></td>
                        <td><span class="<?php echo $status_class; ?>"><?php echo ucfirst($student['status']); ?></span></td>
                    </tr>
                <?php endforeach; ?>
            </table>
        <?php endif; ?>

        <br>
        <a href="/admin/dashboard">Back to Dashboard</a>
    </div>
</body>
</html>
