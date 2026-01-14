<!DOCTYPE html>
<html>
<head>
    <title>Pending Student Requests</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/assets/css/style.css">
</head>
<body>
    <div class="container">
        <h2>Pending Student Requests</h2>

        <?php if (empty($students)): ?>
            <p>No pending student requests.</p>
        <?php else: ?>
            <table>
                <tr><th>Name</th><th>Email</th><th>Action</th></tr>
                <?php foreach ($students as $student): ?>
                    <tr>
                        <td><?php echo $student['name']; ?></td>
                        <td><?php echo $student['email']; ?></td>
                        <td>
                            <a href="/admin/student_action?id=<?php echo $student['user_id']; ?>&action=approve">Approve</a> | 
                            <a href="/admin/student_action?id=<?php echo $student['user_id']; ?>&action=reject">Reject</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>
        <?php endif; ?>

        <br>
        <a href="/admin/dashboard">Back to Dashboard</a>
    </div>
</body>
</html>
