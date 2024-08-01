<?php

include 'libraries/Database.php';
include 'Validator.php';

$name = trim($_POST['name']);
$email = trim($_POST['email']);
$password = trim($_POST['password']);

$validator = new Validator($_POST);
$errors = $validator->validate();
if (!empty($errors)) {
    echo json_encode(['errors' => $errors]);
    exit;
} else {
        $db = Database::getInstance();
        if (!$db->conn) {
            echo json_encode(['errors' => ['Не удалось подключиться к базе данных.']]);
            exit;
        }
    
        $query = 'INSERT INTO users (name, email, password)
        VALUES (:name, :email, :password)';

        $params = [
            'name' => $name,
            'email' => $email,
            'password' => $password  
        ];

        try {
            $statement = $db->conn->prepare($query);

            $statement->execute($params);
            echo json_encode(['name' => $name]);
        } catch (PDOException $e) {
            echo json_encode(['errors' => ['Ошибка при выполнении запроса: ' . $e->getMessage()]]);
        }
}
