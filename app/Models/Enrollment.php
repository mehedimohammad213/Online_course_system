<?php

namespace App\Models;

use App\Core\Model;

class Enrollment extends Model {
    public function getPendingRequests() {
        $sql = "SELECT er.request_id, u.name, c.course_title
                FROM enrollment_requests er
                JOIN users u ON er.student_id = u.user_id
                JOIN courses c ON er.course_id = c.course_id
                WHERE er.request_status = 'pending'
                ORDER BY er.created_at DESC";
        $result = mysqli_query($this->db, $sql);
        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }

    public function updateStatus($request_id, $status) {
        $request_id = (int)$request_id;
        $status = mysqli_real_escape_string($this->db, $status);
        
        $sql = "UPDATE enrollment_requests SET request_status='$status' WHERE request_id=$request_id";
        return mysqli_query($this->db, $sql);
    }

    public function createRequest($student_id, $course_id) {
        $student_id = (int)$student_id;
        $course_id = (int)$course_id;
        $sql = "INSERT INTO enrollment_requests (student_id, course_id, request_status) VALUES ($student_id, $course_id, 'pending')";
        return mysqli_query($this->db, $sql);
    }

    public function checkRequest($student_id, $course_id) {
        $student_id = (int)$student_id;
        $course_id = (int)$course_id;
        $result = mysqli_query($this->db, "SELECT * FROM enrollment_requests WHERE student_id=$student_id AND course_id=$course_id");
        return mysqli_num_rows($result) > 0;
    }

    public function getByStudentId($student_id, $status = null) {
        $student_id = (int)$student_id;
        $sql = "SELECT c.course_id, c.course_title, c.description, er.request_status
                FROM enrollment_requests er
                JOIN courses c ON er.course_id = c.course_id
                WHERE er.student_id = $student_id";
        if ($status) {
            $status = mysqli_real_escape_string($this->db, $status);
            $sql .= " AND er.request_status = '$status'";
        }
        $sql .= " ORDER BY er.created_at DESC";
        $result = mysqli_query($this->db, $sql);
        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }
}
