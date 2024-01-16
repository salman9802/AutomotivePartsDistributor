<?php
    require('../../db/dbconnect.php');
    $users = $pdo->query('SELECT * FROM users');
    // echo "<pre>";
    // print_r($users->fetchAll());
    // echo "</pre>";
    // echo "<pre><code>";    
    // echo json_encode($users->fetchAll(), JSON_PRETTY_PRINT);
    // echo "</code></pre>";

    if($_SERVER['REQUEST_METHOD'] === 'GET'){
    echo json_encode($users->fetchAll(), JSON_PRETTY_PRINT);
    }
?>