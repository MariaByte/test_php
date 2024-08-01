<?php
session_start();

$response = ['auth' => false];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $login = $_POST['login'] ?? '';
    $password = $_POST['password'] ?? '';

    if ($login === 'admin' && $password === 'admin') {
        $_SESSION['auth'] = true;
        $response['auth'] = true;
    }
}

header('Content-Type: application/json');
echo json_encode($response);
