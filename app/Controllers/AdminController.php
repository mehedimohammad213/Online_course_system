<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Models\User;
use App\Models\Course;
use App\Models\Enrollment;

class AdminController extends Controller {
    public function __construct() {
        if (!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
            $this->redirect('/auth/login');
        }
    }

    public function dashboard() {
        $this->view('admin/dashboard');
    }

    // Student Management
    public function approve_students() {
        $userModel = new User();
        $this->view('admin/approve_students', ['students' => $userModel->getByRoleAndStatus('student', 'pending')]);
    }

    public function view_students() {
        $userModel = new User();
        $this->view('admin/view_students', ['students' => $userModel->getByRoleAndStatus('student')]);
    }

    public function student_action() {
        if (isset($_GET['id']) && isset($_GET['action'])) {
            $userModel = new User();
            $status = ($_GET['action'] == 'approve') ? 'approved' : 'rejected';
            $userModel->updateStatus($_GET['id'], $status);
        }
        $this->redirect('/admin/approve_students');
    }

    // Instructor Management
    public function approve_instructors() {
        $userModel = new User();
        $this->view('admin/approve_instructors', ['instructors' => $userModel->getByRoleAndStatus('instructor', 'pending')]);
    }

    public function view_instructors() {
        $userModel = new User();
        $this->view('admin/view_instructors', ['instructors' => $userModel->getByRoleAndStatus('instructor')]);
    }

    public function instructor_action() {
        if (isset($_GET['id']) && isset($_GET['action'])) {
            $userModel = new User();
            $status = ($_GET['action'] == 'approve') ? 'approved' : 'rejected';
            $userModel->updateStatus($_GET['id'], $status);
        }
        $this->redirect('/admin/approve_instructors');
    }

    // Course Management
    public function add_course() {
        if (isset($_POST['add'])) {
            $courseModel = new Course();
            if ($courseModel->create($_POST['title'], $_POST['description'])) {
                $this->view('admin/add_course', ['success' => 'Course Added Successfully']);
            } else {
                $this->view('admin/add_course', ['error' => 'Failed to add course']);
            }
        } else {
            $this->view('admin/add_course');
        }
    }

    public function view_courses() {
        $courseModel = new Course();
        $this->view('admin/view_courses', ['courses' => $courseModel->getAll()]);
    }

    public function update_course($id) {
        $courseModel = new Course();
        if (isset($_POST['update'])) {
            if ($courseModel->update($id, $_POST['title'], $_POST['description'])) {
                $course = $courseModel->getById($id);
                $this->view('admin/update_course', ['success' => 'Course Updated Successfully', 'course' => $course]);
            } else {
                $course = $courseModel->getById($id);
                $this->view('admin/update_course', ['error' => 'Failed to update course', 'course' => $course]);
            }
        } else {
            $course = $courseModel->getById($id);
            $this->view('admin/update_course', ['course' => $course]);
        }
    }

    public function delete_course($id) {
        $courseModel = new Course();
        $courseModel->delete($id);
        $this->redirect('/admin/view_courses');
    }

    public function assign_instructor() {
        $courseModel = new Course();
        $userModel = new User();
        
        if (isset($_POST['assign'])) {
            if ($courseModel->assignInstructor($_POST['course_id'], $_POST['instructor_id'])) {
                $this->view('admin/assign_instructor', [
                    'success' => 'Instructor Assigned Successfully',
                    'courses' => $courseModel->getAll(),
                    'instructors' => $userModel->getByRoleAndStatus('instructor', 'approved')
                ]);
            } else {
                $this->view('admin/assign_instructor', [
                    'error' => 'Failed to assign instructor',
                    'courses' => $courseModel->getAll(),
                    'instructors' => $userModel->getByRoleAndStatus('instructor', 'approved')
                ]);
            }
        } else {
            $this->view('admin/assign_instructor', [
                'courses' => $courseModel->getAll(),
                'instructors' => $userModel->getByRoleAndStatus('instructor', 'approved')
            ]);
        }
    }

    // Enrollment Management
    public function enrollment_requests() {
        $enrollmentModel = new Enrollment();
        $this->view('admin/enrollment_requests', ['requests' => $enrollmentModel->getPendingRequests()]);
    }

    public function enrollment_action() {
        if (isset($_GET['id']) && isset($_GET['action'])) {
            $enrollmentModel = new Enrollment();
            $status = ($_GET['action'] == 'approve') ? 'approved' : 'rejected';
            $enrollmentModel->updateStatus($_GET['id'], $status);
        }
        $this->redirect('/admin/enrollment_requests');
    }
}
