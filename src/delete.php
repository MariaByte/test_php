<?php

include 'libraries/Database.php';

$ids = $_POST['id'];

if (!empty($ids)) {
    $db = new Database();

    $query = 'DELETE FROM users WHERE id IN (' . implode(',', array_fill(0, count($ids), '?')) . ')';
    
    $statement = $db->conn->prepare($query);

    $statement->execute($ids);

    echo json_encode(['status' => 'success']);
} else {
    echo json_encode(['status' => 'error', 'message' => 'No IDs provided']);
}
