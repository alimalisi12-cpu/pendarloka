<?php
// app/Controllers/AuthController.php

require_once dirname(__DIR__, 2) . '/config/app.php';
require_once dirname(__DIR__) . '/Models/User.php';

class AuthController {
    private $userModel;

    public function __construct() {
        $this->userModel = new User();
    }

    public function login() {
        if (is_logged_in()) {
            redirect(is_admin() ? 'admin' : 'dashboard');
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = sanitize($_POST['email'] ?? '');
            $password = $_POST['password'] ?? '';

            if (empty($email) || empty($password)) {
                set_flash('error', 'Email dan password wajib diisi!');
                redirect('login');
            }

            $user = $this->userModel->findByEmail($email);
            if ($user && password_verify($password, $user['password'])) {
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['user'] = $user;

                set_flash('success', 'Selamat datang kembali, ' . $user['name'] . '!');
                redirect($user['role'] === 'admin' ? 'admin' : 'dashboard');
            } else {
                set_flash('error', 'Email atau password salah. Silakan coba lagi!');
                redirect('login');
            }
        }

        require_once BASE_PATH . '/views/auth/login.php';
    }

    public function register() {
        if (is_logged_in()) {
            redirect('dashboard');
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = sanitize($_POST['name'] ?? '');
            $email = sanitize($_POST['email'] ?? '');
            $phone = sanitize($_POST['phone'] ?? '');
            $password = $_POST['password'] ?? '';

            if (empty($name) || empty($email) || empty($password)) {
                set_flash('error', 'Semua field wajib diisi!');
                redirect('register');
            }

            $existing = $this->userModel->findByEmail($email);
            if ($existing) {
                set_flash('error', 'Email sudah terdaftar. Silakan login!');
                redirect('login');
            }

            $userId = $this->userModel->register($name, $email, $phone, $password);
            $user = $this->userModel->findById($userId);

            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user'] = $user;

            set_flash('success', 'Pendaftaran berhasil! Selamat datang di ' . APP_NAME . '.');
            redirect('dashboard');
        }

        require_once BASE_PATH . '/views/auth/register.php';
    }

    public function logout() {
        session_destroy();
        redirect('');
    }
}
