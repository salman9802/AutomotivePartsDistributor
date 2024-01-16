<?php
    require('../../db/dbconnect.php');
    $users = $pdo->query('SELECT * FROM users');

    if($_SERVER['REQUEST_METHOD'] === 'POST'){
    echo json_encode($users->fetchAll(), JSON_PRETTY_PRINT);
    }
?>