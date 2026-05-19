<?php

# base logic 

require_once BASE_PATH . '/app/config/database.php';

class User
{
    public function findByUsernameOrEmail(string $login): ?object
    {
        $stmt = db()->prepare(
            'SELECT * FROM users WHERE username = ? OR email = ? LIMIT 1'
        );

        $stmt->execute([$login, $login]);

        $user = $stmt->fetch();

        return $user ?: null;
    }

    public function exists(string $username, string $email): bool
    {
        $stmt = db()->prepare(
            'SELECT id FROM users WHERE username = ? OR email = ? LIMIT 1'
        );

        $stmt->execute([$username, $email]);

        return (bool) $stmt->fetch();
    }

    public function create(string $username, string $email, string $password): bool
    {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $stmt = db()->prepare(
            'INSERT INTO users(username, email, password) VALUES (?, ?, ?)'
        );

        return $stmt->execute([$username, $email, $hashedPassword]);
    }
}