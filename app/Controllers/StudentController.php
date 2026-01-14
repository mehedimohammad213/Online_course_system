<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Models\Course;
use App\Models\Enrollment;

class StudentController extends Controller {
    public function __construct() {
        if (!isset($_SESSION['role']) || $_SESSION['role'] != 'student') {
            $this->redirect('/auth/login');
        }
    }

    public function dashboard() {
        $this->view('student/dashboard');
    }

    public function course_list() {
        $courseModel = new Course();
        $this->view('student/course_list', ['courses' => $courseModel->getAll('active')]);
    }

    public function enroll($course_id) {
        $enrollmentModel = new Enrollment();
        $student_id = $_SESSION['user_id'];

        if ($enrollmentModel->checkRequest($student_id, $course_id)) {
            $this->view('student/enroll_status', [
                'message' => 'You have already sent an enrollment request for this course.',
                'class' => 'error'
            ]);
        } else {
            if ($enrollmentModel->createRequest($student_id, $course_id)) {
                 $this->view('student/enroll_status', [
                    'message' => 'Enrollment request sent successfully.',
                    'class' => 'success'
                ]);
            } else {
                 $this->view('student/enroll_status', [
                    'message' => 'Failed to send enrollment request.',
                    'class' => 'error'
                ]);
            }
        }
    }

    public function my_courses() {
        $enrollmentModel = new Enrollment();
        $this->view('student/my_courses', ['courses' => $enrollmentModel->getByStudentId($_SESSION['user_id'])]);
    }

    public function approved_courses() {
        $enrollmentModel = new Enrollment();
        $this->view('student/approved_courses', ['courses' => $enrollmentModel->getByStudentId($_SESSION['user_id'], 'approved')]);
    }
}
