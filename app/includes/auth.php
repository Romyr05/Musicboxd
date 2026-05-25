<?php
// Register a user
// Login a user
// Check if already logged in
// get current user
// protect pages



//using php session


if(session_status() === PHP_SESSION_NONE){
    session_start();
}

require_once __DIR__ . '/../config/database.php';


function isLoggedIn(): bool{
    return isset($_SESSION['user_id']);
}

function userExist(string $username, string $email): bool{
    $stmt = db()->prepare(
        'SELECT id FROM users WHERE username = ? OR email = ? LIMIT 1'
    );

    $stmt->execute([$username, $email]);

    return (bool) $stmt->fetch();  //fetch returns obj must be bool
}

 
function loginUser(object $user): void
{
    session_regenerate_id(true);

    $_SESSION['user_id'] = $user->id;
    $_SESSION['username'] = $user->username;
}

function currentUsername(): ?string
{
    return $_SESSION['username'] ?? null;
}


function requireLogin(): void
{
    if (!isLoggedIn()) {
        header('Location: login');
        exit;
    }
}


function logoutUser(): void
{
    $_SESSION = [];
    session_destroy();
}
