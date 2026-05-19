<?php

require_once BASE_PATH . '/app/includes/auth.php';
require_once BASE_PATH . '/app/models/User.php';

class AuthController
{
    private User $userModel;

    public function __construct()
    {
        $this->userModel = new User();
    }

    public function showLogin(): void
    {
        if (isLoggedIn()) {
            header('Location: ./');
            exit;
        }

        $error = '';

        require BASE_PATH . '/app/views/auth/login.php';
    }

    public function login(): void
    {
        if (isLoggedIn()) {
            header('Location: ./');
            exit;
        }

        $error = '';
        $username = trim($_POST['username'] ?? '');
        $password = $_POST['password'] ?? '';

        if ($username === '' || $password === '') {
            $error = 'Please enter your username/email and password.';
            require BASE_PATH . '/app/views/auth/login.php';
            return;
        }

        $user = $this->userModel->findByUsernameOrEmail($username);

        if ($user && password_verify($password, $user->password)) {
            loginUser($user);
            header('Location: ./');
            exit;
        }

        $error = 'Invalid login credentials.';

        require BASE_PATH . '/app/views/auth/login.php'; #html file
    }

    public function showRegister(): void
    {
        if (isLoggedIn()) {
            header('Location: ./');
            exit;
        }

        $error = '';

        require BASE_PATH . '/app/views/auth/register.php';
    }

    public function register(): void
    {
        if (isLoggedIn()) {
            header('Location: ./');
            exit;
        }

        $error = '';

        $username = trim($_POST['username'] ?? '');
        $email = trim($_POST['email'] ?? '');
        $password = $_POST['password'] ?? '';
        $confirmPassword = $_POST['confirm_password'] ?? '';

        if ($username === '' || $email === '' || $password === '' || $confirmPassword === '') {
            $error = 'Fields are missing';
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $error = 'Enter valid email';
        } elseif ($password !== $confirmPassword) {
            $error = 'Passwords do not match.';
        } elseif ($this->userModel->exists($username, $email)) {
            $error = 'Username or email already exist';
        } else {
            $this->userModel->create($username, $email, $password);
            header('Location: login');
            exit;
        }

        require BASE_PATH . '/app/views/auth/register.php';
    }
}