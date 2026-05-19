<?php
// For HTML purposes only

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link rel="stylesheet" href="assets/css/login_style.css">
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

                    <a href="register" class="register-link">Register Account</a>
                </form>
            </div>
        </section>
    </main>
</body>
</html>
