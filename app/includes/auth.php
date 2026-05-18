<?php



//using php session


if(session_status() === PHP_SESSION_NONE){
    session_start();
}

require_once __DIR__ . '/../config/database.php';


function isLoggedIn(): bool{
    return isset($_SESSION['user_id']);
}

function userExist(string $username, $email): bool{
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


function requireLogin(): void
{
    if (!isLoggedIn()) {
        header('Location: pages/login.php');
        exit;
    }
}


function logoutUser(): void
{
    $_SESSION = [];
    session_destroy();
}
