<!DOCTYPE html>
<html>
<head>
    <title>Approve Instructors</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/assets/css/style.css">
</head>
<body>
    <div class="container">
        <h2>Approve Instructors</h2>

        <?php if (empty($instructors)): ?>
            <p>No pending instructor requests.</p>
        <?php else: ?>
            <table>
                <tr><th>Name</th><th>Email</th><th>Action</th></tr>
                <?php foreach ($instructors as $instructor): ?>
                    <tr>
                        <td><?php echo $instructor['name']; ?></td>
                        <td><?php echo $instructor['email']; ?></td>
                        <td>
                            <a href="/admin/instructor_action?id=<?php echo $instructor['user_id']; ?>&action=approve">Approve</a> | 
                            <a href="/admin/instructor_action?id=<?php echo $instructor['user_id']; ?>&action=reject">Reject</a>
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
