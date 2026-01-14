# Learn Plus - Online Course Enrollment System

## 📋 Project Overview

**Learn Plus** is a comprehensive web-based online course management system built with PHP and MySQL. The system facilitates course enrollment, management, and delivery with role-based access control for three distinct user types: Administrators, Students, and Instructors.

The platform enables educational institutions to manage courses, handle student enrollments, assign instructors, and provide course materials and notices in a centralized, user-friendly environment.

---

## ✨ Key Features

### 🔐 Authentication & Authorization
- **Multi-role Registration**: Separate registration flows for Students and Instructors
- **Role-based Access Control**: Three distinct user roles (Admin, Student, Instructor)
- **Approval System**: Admin approval required for Student and Instructor registrations
- **Session Management**: Secure session-based authentication

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

- **Backend**: PHP 7.4+
- **Database**: MySQL 5.7+ / MariaDB
- **Frontend**: HTML5, CSS3 (Responsive Design)
- **Server**: PHP Built-in Development Server / Apache / Nginx
- **Storage**: File system for uploaded materials

---

## 📁 Project Structure

```
Online_course_system/
├── admin/                    # Admin panel modules
│   ├── add_course.php       # Create new courses
│   ├── approve_enrollment.php
│   ├── approve_instructors.php
│   ├── approve_students.php
│   ├── assign_instructor.php
│   ├── dashboard.php        # Admin dashboard
│   ├── delete_course.php
│   ├── enrollment_requests.php
│   ├── update_course.php
│   ├── view_courses.php
│   ├── view_instructors.php
│   └── view_students.php
│
├── auth/                     # Authentication modules
│   ├── instructor_register.php
│   ├── login.php            # Unified login for all roles
│   ├── logout.php
│   └── register.php         # Student registration
│
├── config/                    # Configuration files
│   ├── db.php               # Database connection
│   └── test_db.php
│
├── instructor/                # Instructor panel modules
│   ├── assigned_courses.php
│   ├── dashboard.php
│   ├── students.php         # View course students
│   ├── update_course.php
│   ├── upload_material.php
│   └── upload_notice.php
│
├── student/                   # Student panel modules
│   ├── approved_courses.php
│   ├── course_list.php      # Browse available courses
│   ├── dashboard.php
│   ├── enroll.php           # Enrollment request
│   └── my_courses.php       # View enrolled courses
│
├── assets/
│   └── css/
│       └── style.css        # Responsive stylesheet
│
├── uploads/                   # Course materials storage
│
├── index.php                 # Landing page
├── setup_database.php        # Database setup script
├── setup_database.sql        # SQL schema file
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
Edit `config/db.php` with your database credentials:
```php
$servername = "127.0.0.1";
$username = "course_user"; // Default user created by AI setup
$password = "course_pass"; // Default password created by AI setup
$dbname = "online_course_db";
$port = 3306;
```

> **Note**: If you are using your own credentials, please update this file accordingly.

### Step 3: Setup Database
Run the setup script to create tables and insert sample data:
```bash
php setup_database.php
```

Alternatively, import the SQL file:
```bash
mysql -u root -p < setup_database.sql
```

### Step 4: Set Permissions
Ensure the `uploads/` directory is writable:
```bash
chmod 755 uploads/
```

### Step 5: Start Server

**Option A: PHP Built-in Server (Development)**
```bash
php -S localhost:8000
```

**Option B: Apache/Nginx**
- Configure virtual host pointing to project root
- Ensure mod_rewrite is enabled (if using .htaccess)

### Step 6: Access Application
Open your browser and navigate to:
```
http://localhost:8000
```

---

## 👥 Default User Accounts

The setup script creates the following test accounts:

| Role | Email | Password |
|------|-------|----------|
| Admin | admin@learnplus.com | admin123 |
| Student | john.student@example.com | student123 |
| Instructor | sarah.instructor@example.com | instructor123 |

**⚠️ Security Note**: Change these passwords in production!

---

## 📖 Usage Guide

### For Administrators

1. **Login**: Use admin credentials at `auth/login.php`
2. **Approve Users**:
   - Navigate to "Approve Students" or "Approve Instructors"
   - Review pending registrations and approve/reject
3. **Manage Courses**:
   - Add new courses via "Add Course"
   - View/Update/Delete courses via "View Courses"
   - Assign instructors to courses via "Assign Instructor"
4. **Handle Enrollments**:
   - View enrollment requests via "Approve Enrollments"
   - Approve or reject student enrollment requests

### For Students

1. **Register**: Create account at `auth/register.php`
2. **Wait for Approval**: Admin must approve registration
3. **Login**: Access dashboard after approval
4. **Browse Courses**: View available courses at "View Available Courses"
5. **Enroll**: Click "Enroll" on desired courses
6. **Access Content**: View approved courses and materials at "My Approved Courses"

### For Instructors

1. **Register**: Create account at `auth/instructor_register.php`
2. **Wait for Approval**: Admin must approve registration
3. **Login**: Access dashboard after approval
4. **View Assigned Courses**: Admin assigns courses to instructors
5. **Manage Course**:
   - Upload course materials
   - Post notices/announcements
   - View enrolled students
   - Update course information

---

## 🔒 Security Considerations

### Current Implementation
- ✅ Session-based authentication
- ✅ Role-based access control
- ✅ SQL injection protection (Comprehensive `mysqli_real_escape_string` usage)
- ✅ File upload directory isolation & Type/Size validation
- ✅ Input validation for all forms (Client-side & Server-side)

### ⚠️ Security Recommendations for Production

1. **Password Security**
   - Implement password hashing (password_hash/password_verify)
   - Enforce strong password policies
   - Add password reset functionality

2. **SQL Injection**
   - Migrate to prepared statements (PDO or mysqli_prepare)
   - Remove direct SQL string concatenation

3. **XSS Protection**
   - Implement output escaping (htmlspecialchars)
   - Validate and sanitize all user inputs

4. **File Upload Security**
   - Validate file types and sizes
   - Scan uploaded files for malware
   - Store files outside web root or use secure file serving

5. **Session Security**
   - Implement CSRF tokens
   - Set secure session cookies
   - Implement session timeout

6. **Input Validation**
   - Server-side validation for all forms
   - Email format validation
   - File type restrictions

7. **Access Control**
   - Implement middleware for route protection
   - Verify user permissions on each action

---

## 🎨 UI/UX Features

- **Responsive Design**: Mobile-friendly layout with CSS media queries
- **Clean Interface**: Modern, minimalist design
- **User Feedback**: Success/error messages for all actions
- **Navigation**: Intuitive dashboard-based navigation
- **Accessibility**: Semantic HTML structure

---

## 📊 Workflow Diagram

```
1. User Registration
   ├─ Student → Pending → Admin Approval → Active
   └─ Instructor → Pending → Admin Approval → Active

2. Course Creation
   Admin → Create Course → Assign Instructor

3. Enrollment Process
   Student → Browse Courses → Request Enrollment → Admin Approval → Enrolled

4. Content Delivery
   Instructor → Upload Materials/Notices → Students Access Content
```

---

## 🐛 Known Issues & Limitations

1. **Password Storage**: Passwords stored in plain text (should use hashing)
2. **SQL Injection Risk**: Some queries use string concatenation
3. **File Upload**: Limit 10MB, restricted to PDF/DOC/TXT/Images
4. **Error Handling**: Limited error handling and logging
5. **Email Functionality**: No email notifications for approvals/enrollments
6. **Search Functionality**: No search feature for courses
7. **Pagination**: No pagination for large data sets
8. **File Download**: No secure file download mechanism

---

## 🔮 Future Enhancements

### High Priority
- [ ] Implement password hashing
- [ ] Migrate to prepared statements
- [ ] Implement file upload security (Advanced scanning)
- [ ] Add email notification system

### Medium Priority
- [ ] Course search and filtering
- [ ] Pagination for course lists
- [ ] Student progress tracking
- [ ] Course ratings and reviews
- [ ] Discussion forums per course
- [ ] Assignment submission system
- [ ] Grade management

### Low Priority
- [ ] Multi-language support
- [ ] Dark mode theme
- [ ] Advanced analytics dashboard
- [ ] Mobile app (React Native/Flutter)
- [ ] Video streaming integration
- [ ] Certificate generation

---

## 🧪 Testing

### Manual Testing Checklist

- [ ] User registration (Student & Instructor)
- [ ] Admin approval workflow
- [ ] Login functionality for all roles
- [ ] Course creation and management
- [ ] Enrollment request and approval
- [ ] Instructor assignment
- [ ] Material upload and access
- [ ] Notice posting
- [ ] Session management
- [ ] Logout functionality

---

## 📝 Code Quality Notes

### Strengths
- ✅ Clear separation of concerns (admin/student/instructor)
- ✅ Consistent file structure
- ✅ Responsive CSS design
- ✅ Basic security measures in place

### Areas for Improvement
- ⚠️ Code duplication (consider creating reusable components)
- ⚠️ No MVC architecture (consider framework migration)
- ⚠️ Limited error handling
- ⚠️ No unit/integration tests
- ⚠️ Hardcoded values (consider configuration files)

---

## 📄 License

This project is provided as-is for educational purposes.

---

## 👨‍💻 Development

### Contributing
1. Fork the repository
2. Create a feature branch
3. Make your changes
4. Test thoroughly
5. Submit a pull request

### Code Style
- Use consistent indentation (spaces or tabs)
- Follow PHP PSR standards
- Comment complex logic
- Use meaningful variable names

---

## 📞 Support

For issues, questions, or contributions, please create an issue in the repository or contact the development team.

---

## 🎯 Project Status

**Current Version**: 1.0.0
**Status**: Functional - Ready for Development/Testing
**Last Updated**: 2024

---

**Built with ❤️ for educational purposes**
