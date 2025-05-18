<?php
session_start();
header('Content-Type: application/json');

if (!isset($_SESSION['user_email'])) {
    echo json_encode(['success' => false, 'error' => 'Not logged in']);
    exit;
}

$data = json_decode(file_get_contents('php://input'), true);
if (!$data) {
    echo json_encode(['success' => false, 'error' => 'Invalid data']);
    exit;
}

$userFile = __DIR__ . '/dataJSON/user_data.json';
$users = json_decode(file_get_contents($userFile), true);

foreach ($users as &$user) {
    if ($user['email'] === $_SESSION['user_email']) {
        if (isset($data['lastname'])) $user['lastname'] = $data['lastname'];
        if (isset($data['name'])) $user['name'] = $data['name'];
        if (isset($data['age'])) $user['age'] = $data['age'];

        if (isset($data['email']) && $data['email'] !== $_SESSION['user_email']) {
            foreach ($users as $u) {
                if ($u['email'] === $data['email']) {
                    echo json_encode(['success' => false, 'error' => 'Email already used']);
                    exit;
                }
            }
            $user['email'] = $data['email'];
            $_SESSION['user_email'] = $data['email'];
        }

        if (!empty($data['pw'])) $user['pass'] = $data['pw'];

        $_SESSION['user_lastname'] = $user['lastname'];
        $_SESSION['user_name'] = $user['name'];
        $_SESSION['user_age'] = $user['age'];
        $user['last_updated'] = time();

        break;
    }
}
unset($user);

file_put_contents($userFile, json_encode($users, JSON_PRETTY_PRINT));

echo json_encode(['success' => true]); 
