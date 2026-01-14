<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Models\User;

class AuthController extends Controller {
    public function login() {
        if (isset($_POST['login'])) {
            $userModel = new User();
            $user = $userModel->login($_POST['email'], $_POST['password']);

            if ($user) {
                $_SESSION['role'] = $user['role'];
                $_SESSION['user_id'] = $user['user_id'];

                if ($user['role'] == 'admin') {
                    $this->redirect('/admin/dashboard');
                } elseif ($user['role'] == 'student') {
                    $this->redirect('/student/dashboard');
                } else {
                    $this->redirect('/instructor/dashboard');
                }
            } else {
                $this->view('auth/login', ['error' => 'Invalid login']);
            }
        } else {
            $this->view('auth/login');
        }
    }

    public function register() {
         $this->handleRegistration('student');
    }

    public function instructor_register() {
         $this->handleRegistration('instructor');
    }

    private function handleRegistration($role) {
        if (isset($_POST['register'])) {
             $userModel = new User();
             $name = $_POST['name'];
             $email = $_POST['email'];
             $password = $_POST['password'];

             $errors = [];
             if (!filter_var($email, FILTER_VALIDATE_EMAIL)) $errors[] = "Invalid email format.";
             if (strlen($password) < 8) $errors[] = "Password must be at least 8 characters long.";
             if ($userModel->findByEmail($email)) $errors[] = "Email already registered.";

             if (empty($errors)) {
                 if ($userModel->create($name, $email, $password, $role)) {
                     $success = "Registration successful. Wait for admin approval.";
                     $view = ($role == 'instructor') ? 'auth/instructor_register' : 'auth/register';
                     $this->view($view, ['success' => $success]);
                 } else {
                     $view = ($role == 'instructor') ? 'auth/instructor_register' : 'auth/register';
                     $this->view($view, ['error' => "Registration failed."]);
                 }
             } else {
                 $view = ($role == 'instructor') ? 'auth/instructor_register' : 'auth/register';
                 $this->view($view, ['errors' => $errors]);
             }
        } else {
             $view = ($role == 'instructor') ? 'auth/instructor_register' : 'auth/register';
             $this->view($view);
        }
    }

    public function logout() {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        session_unset();
        session_destroy();
        $this->redirect('/auth/login');
    }
}
