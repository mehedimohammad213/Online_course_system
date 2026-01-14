<?php

namespace App\Models;

use App\Core\Model;

class Notice extends Model {
    public function create($course_id, $title, $content) {
        $course_id = (int)$course_id;
        $title = mysqli_real_escape_string($this->db, trim($title));
        $content = mysqli_real_escape_string($this->db, trim($content));
        
        $sql = "INSERT INTO notices (course_id, title, content) VALUES ($course_id, '$title', '$content')";
        return mysqli_query($this->db, $sql);
    }
}
