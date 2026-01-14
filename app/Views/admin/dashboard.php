<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/assets/css/style.css">
</head>
<body>
    <div class="container">
        <h2>Admin Dashboard</h2>
        <p>Welcome Admin</p>

        <hr>

        <h3>Course Management</h3>
        <div class="dashboard-links">
            <a href="/admin/add_course">Add Course</a>
            <a href="/admin/view_courses">View / Update / Delete Courses</a>
        </div>

        <hr>

        <h3>User & Enrollment Management</h3>
        <div class="dashboard-links">
            <a href="/admin/approve_students">Approve Students</a>
            <a href="/admin/approve_instructors">Approve Instructors</a>
            <a href="/admin/view_students">View All Students</a>
            <a href="/admin/view_instructors">View All Instructors</a>
            <a href="/admin/enrollment_requests">Approve Enrollments</a>
            <a href="/admin/assign_instructor">Assign Instructor</a>
        </div>

        <hr>

        <a href="/auth/logout">Logout</a>
    </div>
</body>
</html>
