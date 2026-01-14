<?php

namespace App\Models;

use App\Core\Model;

class Course extends Model {
    public function getAll($status = null) {
        $sql = "SELECT * FROM courses";
        if ($status) {
            $status = mysqli_real_escape_string($this->db, $status);
            $sql .= " WHERE status='$status'";
        }
        $sql .= " ORDER BY created_at DESC";
        $result = mysqli_query($this->db, $sql);
        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }

    public function create($title, $description) {
        $title = mysqli_real_escape_string($this->db, trim($title));
        $description = mysqli_real_escape_string($this->db, trim($description));
        $sql = "INSERT INTO courses (course_title, description, status) VALUES ('$title', '$description', 'active')";
        return mysqli_query($this->db, $sql);
    }

    public function getById($id) {
        $id = (int)$id;
        $result = mysqli_query($this->db, "SELECT * FROM courses WHERE course_id=$id");
        return mysqli_fetch_assoc($result);
    }

    public function update($id, $title, $description) {
        $id = (int)$id;
        $title = mysqli_real_escape_string($this->db, trim($title));
        $description = mysqli_real_escape_string($this->db, trim($description));
        $sql = "UPDATE courses SET course_title='$title', description='$description' WHERE course_id=$id";
        return mysqli_query($this->db, $sql);
    }

    public function delete($id) {
        $id = (int)$id;
        $sql = "DELETE FROM courses WHERE course_id=$id";
        return mysqli_query($this->db, $sql);
    }

    public function assignInstructor($course_id, $instructor_id) {
        $course_id = (int)$course_id;
        $instructor_id = (int)$instructor_id;
        $sql = "UPDATE courses SET instructor_id=$instructor_id WHERE course_id=$course_id";
        return mysqli_query($this->db, $sql);
    }

    public function getByInstructorId($instructor_id) {
        $instructor_id = (int)$instructor_id;
        $result = mysqli_query($this->db, "SELECT * FROM courses WHERE instructor_id=$instructor_id");
        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }

    public function isAssigned($course_id, $instructor_id) {
        $course_id = (int)$course_id;
        $instructor_id = (int)$instructor_id;
        $result = mysqli_query($this->db, "SELECT * FROM courses WHERE course_id=$course_id AND instructor_id=$instructor_id");
        return mysqli_num_rows($result) > 0;
    }

    public function getStudents($course_id) {
        $course_id = (int)$course_id;
        $sql = "SELECT u.name, u.email
                FROM enrollment_requests er
                JOIN users u ON er.student_id = u.user_id
                WHERE er.course_id = $course_id
                AND er.request_status = 'approved'
                ORDER BY u.name";
        $result = mysqli_query($this->db, $sql);
        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }
}
