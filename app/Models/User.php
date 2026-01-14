<?php

namespace App\Models;

use App\Core\Model;

class User extends Model {
    public function login($email, $password) {
        $email = mysqli_real_escape_string($this->db, trim($email));
        // Note: In a production app, password hashing (password_verify) should be used.
        // Sticking to existing logic of plain text check for refactor parity.
        $password = mysqli_real_escape_string($this->db, $password);

        $sql = "SELECT * FROM users WHERE email='$email' AND password='$password' AND status='approved'";
        $result = mysqli_query($this->db, $sql);

        if (mysqli_num_rows($result) == 1) {
            return mysqli_fetch_assoc($result);
        }
        return false;
    }

    public function findByEmail($email) {
        $email = mysqli_real_escape_string($this->db, $email);
        $result = mysqli_query($this->db, "SELECT email FROM users WHERE email='$email'");
        return mysqli_num_rows($result) > 0;
    }

    public function create($name, $email, $password, $role) {
        $name = mysqli_real_escape_string($this->db, trim($name));
        $email = mysqli_real_escape_string($this->db, trim($email));
        $password = mysqli_real_escape_string($this->db, $password);
        
        $sql = "INSERT INTO users (name, email, password, role, status) VALUES ('$name', '$email', '$password', '$role', 'pending')";
        return mysqli_query($this->db, $sql);
    }

    public function getByRoleAndStatus($role, $status = null) {
        $role = mysqli_real_escape_string($this->db, $role);
        $sql = "SELECT * FROM users WHERE role='$role'";
        if ($status) {
            $status = mysqli_real_escape_string($this->db, $status);
            $sql .= " AND status='$status'";
        }
        $sql .= " ORDER BY created_at DESC";
        $result = mysqli_query($this->db, $sql);
        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }

    public function updateStatus($id, $status) {
        $id = (int)$id;
        $status = mysqli_real_escape_string($this->db, $status);
        $sql = "UPDATE users SET status='$status' WHERE user_id=$id";
        return mysqli_query($this->db, $sql);
    }
}
