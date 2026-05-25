<?php

require_once __DIR__ . '/../../includes/auth.php';

if (isLoggedIn()) {
    header('Location: /');
    exit;
}

$error = '';


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';

    if ($username === '' || $password === '') {
        $error = 'Please enter your username/email and password.';
    } else {
        $stmt = db()->prepare(
            'SELECT * FROM users WHERE username = ? OR email = ? LIMIT 1'
        );

        $stmt->execute([$username, $username]);
        $user = $stmt->fetch();

        if ($user && password_verify($password, $user->password)) {
            loginUser($user);

            header('Location: /');
            exit;
        }

        $error = 'Invalid login credentials.';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link rel="stylesheet" href="/assets/css/login_style.css">
</head>
<body class="login-page">
    <main class="login-shell">

        <section class="login-panel">
            <div class="login-content">
                <h1>Musicboxd</h1>

                <form class="login-form" method="POST">
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

                    <label for="password">Password</label>
                    <input
                        type="password"
                        id="password"
                        name="password"
                        placeholder="Value"
                        required
                    >

                    <button type="submit">Sign In</button>

                    <a href="/pages/register.php" class="register-link">Register Account</a>
                </form>
            </div>
        </section>
    </main>
</body>
</html>
