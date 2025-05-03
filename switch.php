<?php require_once 'init.php';

$currentMode = ($_COOKIE['mode'] ?? 'sombre') === 'clair' ? 'clair' : 'sombre';
$newMode = $currentMode === 'clair' ? 'sombre' : 'clair';

setcookie("mode", $newMode, time() + 3600 * 24 * 30, "/");

$redirect = $_SERVER['HTTP_REFERER'] ?? 'home.php';
header("Location: $redirect");
exit;