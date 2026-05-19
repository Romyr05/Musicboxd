<?php

require_once __DIR__ . '/../../includes/auth.php';

if (isLoggedIn()) {
    header('Location: ./');
    exit;
}


$error = '';


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
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
    } else {
        if (userExist($username, $email)) {
            $error = 'Username or email already exist';
        } else {
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            $stmt = db()->prepare(
                'INSERT INTO users(username, email, password) VALUES (?, ?, ?)'
            );

            $stmt->execute([$username, $email, $hashedPassword]);

            header('Location: login');
            exit;
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Page</title>
    <link rel="stylesheet" href="assets/css/register_style.css">
</head>
<body class="register-page">
    <main class="register-shell">
        <section class="register-panel">
            <div class="register-content">
                <h1>Musicboxd</h1>

                <form class="register-form" method="POST">
                    <?php if ($error !== ''): ?>
                        <p class="form-error"><?= htmlspecialchars($error) ?></p>
                    <?php endif; ?>

                    <label for="username">Username</label>
                    <input
                        type="text"
                        id="username"
                        name="username"
                        placeholder="Value"
                        value="<?= htmlspecialchars($_POST['username'] ?? '') ?>"
                        required
                    >

                    <label for="email">Email</label>
                    <input
                        type="email"
                        id="email"
                        name="email"
                        placeholder="Value"
                        value="<?= htmlspecialchars($_POST['email'] ?? '') ?>"
                        required
                    >

                    <label for="password">Password</label>
                    <input
                        type="password"
                        id="password"
                        name="password"
                        placeholder="Value"
                        required
                    >

                    <label for="confirm_password">Confirm Password</label>
                    <input
                        type="password"
                        id="confirm_password"
                        name="confirm_password"
                        placeholder="Value"
                        required
                    >

                    <button type="submit">Create Account</button>

                    <a href="login" class="login-link">Already have an account?</a>
                </form>
            </div>
        </section>
    </main>
</body>
</html>
