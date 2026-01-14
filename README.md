# Learn Plus - Online Course Enrollment System

## 📋 Project Overview

**Learn Plus** is a comprehensive web-based online course management system built with PHP and MySQL, following the **Model-View-Controller (MVC)** architecture. The system facilitates course enrollment, management, and delivery with role-based access control for three distinct user types: Administrators, Students, and Instructors.

The platform enables educational institutions to manage courses, handle student enrollments, assign instructors, and provide course materials and notices in a centralized, user-friendly environment.

---

## ✨ Key Features

### 🔐 Authentication & Authorization
- **Multi-role Registration**: Separate registration flows for Students and Instructors
- **Role-based Access Control**: Three distinct user roles (Admin, Student, Instructor)
- **Approval System**: Admin approval required for Student and Instructor registrations
- **Session Management**: Secure session-based authentication
- **MVC Routing**: Clean URLs handled via a centralized entry point

### 👨‍💼 Admin Features
- **User Management**
  - Approve/Reject Student registrations
  - Approve/Reject Instructor registrations
  - View all Students and Instructors
- **Course Management**
  - Create new courses
  - View all courses
  - Update course details
  - Delete courses
  - Assign instructors to courses
- **Enrollment Management**
  - View all enrollment requests
  - Approve/Reject student enrollment requests

### 👨‍🎓 Student Features
- **Course Discovery**
  - Browse available courses
  - View course descriptions
- **Enrollment**
  - Request enrollment in courses
  - View enrollment status (pending/approved/rejected)
  - View enrolled courses
  - View approved courses with access to materials

### 👨‍🏫 Instructor Features
- **Course Management**
  - View assigned courses
  - Update course information
  - View enrolled students per course
- **Content Delivery**
  - Upload course materials (files)
  - Post course notices/announcements

---

## 🛠️ Technology Stack

- **Architecture**: Model-View-Controller (MVC)
- **Backend**: PHP 7.4+
- **Database**: MySQL 5.7+ / MariaDB
- **Frontend**: HTML5, CSS3 (Responsive Design)
- **Server**: PHP Built-in Development Server / Apache / Nginx
- **Storage**: File system for uploaded materials (`public/uploads`)

---

## 📁 Project Structure

```
Online_course_system/
├── app/                        # Core application logic
│   ├── Controllers/           # Controller classes
│   ├── Core/                  # Router, Database, and base classes
│   ├── Models/                # Data interaction classes
│   └── Views/                 # UI templates (PHP/HTML)
│
├── public/                     # Public web root
│   ├── assets/                # CSS and static files
│   ├── uploads/               # Course materials storage
│   └── index.php              # Entry point & autoloader
│
└── README.md
```

---

## 🗄️ Database Schema

### Tables

1. **users**
   - `user_id` (Primary Key)
   - `name`, `email` (Unique), `password`
   - `role` (ENUM: 'admin', 'student', 'instructor')
   - `status` (ENUM: 'pending', 'approved', 'rejected')
   - `created_at`

2. **courses**
   - `course_id` (Primary Key)
   - `course_title`, `description`
   - `instructor_id` (Foreign Key → users.user_id)
   - `status` (ENUM: 'active', 'inactive')
   - `created_at`

3. **enrollment_requests**
   - `request_id` (Primary Key)
   - `student_id` (Foreign Key → users.user_id)
   - `course_id` (Foreign Key → courses.course_id)
   - `request_status` (ENUM: 'pending', 'approved', 'rejected')
   - `created_at`
   - Unique constraint on (student_id, course_id)

4. **materials**
   - `material_id` (Primary Key)
   - `course_id` (Foreign Key → courses.course_id)
   - `title`, `file_path`
   - `created_at`

5. **notices**
   - `notice_id` (Primary Key)
   - `course_id` (Foreign Key → courses.course_id)
   - `title`, `content`
   - `created_at`

---

## 🚀 Installation & Setup

### Prerequisites
- PHP 7.4 or higher
- MySQL 5.7+ or MariaDB
- Web server (Apache/Nginx) or PHP built-in server
- MySQL service running

### Step 1: Clone/Download Project
```bash
cd /path/to/project
```

### Step 2: Configure Database
Edit `app/Core/Database.php` with your database credentials:
```php
$servername = "127.0.0.1";
$username = "course_user";
$password = "course_pass";
$dbname = "online_course_db";
$port = 3306;
```

### Step 3: Setup Database
Run the schema setup:
```bash
mysql -u root -p < setup_database.sql
```

### Step 4: Set Permissions
Ensure the `public/uploads/` directory is writable:
```bash
chmod 755 public/uploads/
```

### Step 5: Start Server
**CRITICAL**: You must serve the `public/` directory as the document root.

**Option A: PHP Built-in Server (Development)**
```bash
php -S localhost:8000 -t public
```

**Option B: Apache/Nginx**
- Configure virtual host pointing to the `public/` directory.

### Step 6: Access Application
Open your browser and navigate to:
```
http://localhost:8000
```

---

## 👥 Default User Accounts

| Role | Email | Password |
|------|-------|----------|
| Admin | admin@learnplus.com | admin123 |
| Student | john.student@example.com | student123 |
| Instructor | sarah.instructor@example.com | instructor123 |

**⚠️ Security Note**: Change these passwords in production!

---

## 📖 Usage Guide

### For Administrators
1. **Login**: Access `/auth/login`
2. **Dashboard**: Navigate to `/admin/dashboard`
3. **Actions**: Manage users and courses via the dashboard.

### For Students
1. **Register**: Access `/auth/register`
2. **Login**: Access `/auth/login` after approval.
3. **Enroll**: Browse courses at `/student/course_list`.

### For Instructors
1. **Register**: Access `/auth/instructor_register`
2. **Actions**: Manage assigned courses via `/instructor/dashboard`.

---

## 📄 License
This project is provided as-is for educational purposes.

---

**Built with ❤️ for educational purposes**
