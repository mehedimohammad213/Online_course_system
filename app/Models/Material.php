<?php

namespace App\Models;

use App\Core\Model;

class Material extends Model {
    public function create($course_id, $title, $file_path) {
        $course_id = (int)$course_id;
        $title = mysqli_real_escape_string($this->db, trim($title));
        $file_path = mysqli_real_escape_string($this->db, $file_path);
        
        $sql = "INSERT INTO materials (course_id, title, file_path) VALUES ($course_id, '$title', '$file_path')";
        return mysqli_query($this->db, $sql);
    }
}
