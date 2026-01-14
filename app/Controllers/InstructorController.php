<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Models\Course;
use App\Models\Material;
use App\Models\Notice;

class InstructorController extends Controller {
    public function __construct() {
        if (!isset($_SESSION['role']) || $_SESSION['role'] != 'instructor') {
            $this->redirect('/auth/login');
        }
    }

    public function dashboard() {
        $this->view('instructor/dashboard');
    }

    public function assigned_courses() {
        $courseModel = new Course();
        $courses = $courseModel->getByInstructorId($_SESSION['user_id']);
        $this->view('instructor/assigned_courses', ['courses' => $courses]);
    }

    public function students($course_id) {
        $courseModel = new Course();
        if (!$courseModel->isAssigned($course_id, $_SESSION['user_id'])) {
            die("Unauthorized access to this course.");
        }
        $students = $courseModel->getStudents($course_id);
        $this->view('instructor/students', ['students' => $students]);
    }

    public function upload_material($course_id) {
        $courseModel = new Course();
        if (!$courseModel->isAssigned($course_id, $_SESSION['user_id'])) {
            die("Unauthorized access to this course.");
        }

        if (isset($_POST['upload'])) {
            $materialModel = new Material();
            $title = $_POST['title'];
            $file = $_FILES['file'];
            
            $allowed_extensions = ['pdf', 'doc', 'docx', 'txt', 'jpg', 'jpeg', 'png'];
            $file_ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));

            if (empty($title)) {
                $this->view('instructor/upload_material', ['error' => 'Title is required', 'course_id' => $course_id]);
            } elseif (!in_array($file_ext, $allowed_extensions)) {
                 $this->view('instructor/upload_material', ['error' => 'Invalid file type', 'course_id' => $course_id]);
            } elseif ($file['size'] > 10 * 1024 * 1024) {
                 $this->view('instructor/upload_material', ['error' => 'File size exceeds 10MB', 'course_id' => $course_id]);
            } else {
                $new_file_name = time() . "_" . $file['name'];
                if (move_uploaded_file($file['tmp_name'], "../public/uploads/" . $new_file_name)) {
                    $materialModel->create($course_id, $title, $new_file_name);
                    $this->view('instructor/upload_material', ['success' => 'Material Uploaded Successfully', 'course_id' => $course_id]);
                } else {
                    $this->view('instructor/upload_material', ['error' => 'Error uploading file', 'course_id' => $course_id]);
                }
            }
        } else {
            $this->view('instructor/upload_material', ['course_id' => $course_id]);
        }
    }

    public function upload_notice($course_id) {
        $courseModel = new Course();
        if (!$courseModel->isAssigned($course_id, $_SESSION['user_id'])) {
            die("Unauthorized access to this course.");
        }

        if (isset($_POST['upload'])) {
            $noticeModel = new Notice();
            if ($noticeModel->create($course_id, $_POST['title'], $_POST['content'])) {
                 $this->view('instructor/upload_notice', ['success' => 'Notice Uploaded Successfully', 'course_id' => $course_id]);
            } else {
                 $this->view('instructor/upload_notice', ['error' => 'Failed to upload notice', 'course_id' => $course_id]);
            }
        } else {
            $this->view('instructor/upload_notice', ['course_id' => $course_id]);
        }
    }

    public function update_course($course_id) {
        $courseModel = new Course();
        if (!$courseModel->isAssigned($course_id, $_SESSION['user_id'])) {
            die("Unauthorized access to this course.");
        }

        if (isset($_POST['update'])) {
            if ($courseModel->update($course_id, $_POST['title'], $_POST['description'])) {
                 $course = $courseModel->getById($course_id);
                 $this->view('instructor/update_course', ['success' => 'Course Updated Successfully', 'course' => $course]);
            } else {
                 $course = $courseModel->getById($course_id);
                 $this->view('instructor/update_course', ['error' => 'Failed to update course', 'course' => $course]);
            }
        } else {
            $course = $courseModel->getById($course_id);
            $this->view('instructor/update_course', ['course' => $course]);
        }
    }
}
