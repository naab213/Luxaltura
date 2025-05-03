<?php require_once 'init.php';
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$user_id = $_SESSION['user_id'] ?? null;

$theme = ($_COOKIE['mode'] ?? 'sombre') === 'clair' ? 'clair' : 'sombre';
$cssFile = $theme === 'clair' ? 'style2.css' : 'style.css';
?>