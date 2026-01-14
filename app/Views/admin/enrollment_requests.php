<!DOCTYPE html>
<html>
<head>
    <title>Enrollment Requests</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/assets/css/style.css">
</head>
<body>
    <div class="container">
        <h2>Enrollment Requests</h2>

        <?php if (empty($requests)): ?>
            <p>No pending enrollment requests.</p>
        <?php else: ?>
            <table>
                <tr><th>Student Name</th><th>Course</th><th>Action</th></tr>
                <?php foreach ($requests as $request): ?>
                    <tr>
                        <td><?php echo $request['name']; ?></td>
                        <td><?php echo $request['course_title']; ?></td>
                        <td>
                            <a href="/admin/enrollment_action?id=<?php echo $request['request_id']; ?>&action=approve">Approve</a> | 
                            <a href="/admin/enrollment_action?id=<?php echo $request['request_id']; ?>&action=reject">Reject</a>
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
