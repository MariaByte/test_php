<?php
include 'libraries/Database.php';
include 'functions.php';

$db = new Database(); 
    
$query = 'SELECT * FROM users';

$statement = $db->conn->prepare($query);

$statement->execute();
$data = $statement->fetchAll(PDO::FETCH_ASSOC);

echo renderTemplate('views/tableUsers.php', ['users' => $data]);
