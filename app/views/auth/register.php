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
