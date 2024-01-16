<?php
    require('../../db/dbconnect.php');
    
    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        if(isset($_POST['id'])){
            $users = $pdo->query('SELECT * FROM users WHERE id = ' . $_POST['id']);
            echo json_encode($users->fetchAll(), JSON_PRETTY_PRINT);
        }else{
            echo json_encode(['message' => 'Please provide id']);
        }
    }
?>