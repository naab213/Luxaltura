<?php
header('Content-Type: application/json');

$userFile = __DIR__ . '/dataJSON/user_data.json';

if (!file_exists($userFile)) {
    echo json_encode(['success' => false, 'error' => 'User file not found']);
    exit;
}

$users = json_decode(file_get_contents($userFile), true);

if (!$users) {
    echo json_encode(['success' => false, 'error' => 'Invalid user data']);
    exit;
}

echo json_encode([
    'success' => true,
    'users' => $users
]);
