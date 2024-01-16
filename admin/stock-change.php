<?php
    if (session_status() === PHP_SESSION_NONE) 
        session_start();
    if (!isset($_SESSION['alogged_in']) && $_SESSION['alogged_in'] !== true)
        header('Location: ../admin');
    require('../db/dbconnect.php');

    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        if(isset($_POST['change_status'])){
            $part_id = $_POST['part_id'];
            if($get_status->execute(['part_id' => $part_id])){
                $part = $get_status->fetch();
                $status = $part->status === 'instock' ? 'outofstock': 'instock';
                $request = $part->request === 1 ? 0 : 1;
                if($change_request->execute(['request' => $request, 'part_id' => $part_id])){
                    if($change_status->execute(['status' => $status, 'part_id' => $part_id])){
                        echo "<script>alert('Successfully Changed Status');</script>";
                    }
                }
            }
            
        }
    }
    $requested_parts = $pdo->query("SELECT * FROM parts WHERE request = ".true);
    $requested_parts = $requested_parts->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Skyline Automotive | Change Stock</title>

    <?php require('../inc/globals.php'); ?>

    <link rel="stylesheet" href="css/company-header.css">
    <link rel="stylesheet" href="css/stock-change.css">
</head>
<body>
<?php require('header.php'); ?>

    <div class="stock-change">
        <?php if(isset($requested_parts) && count($requested_parts) != 0): ?>
            <table class="stock__table">
                <thead>
                    <caption>Stock Change Request</caption>
                    <tr>
                        <th>Part Id</th>
                        <th>Part Model</th>
                        <th>Part Name</th>
                        <th>Request to make</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($requested_parts as $part) :?>
                        <tr>
                            <td><?= $part->id; ?></td>
                            <td><?= $part->model; ?></td>
                            <td><?= $part->name; ?></td>
                            <td><?= "outofstock" ?></td>
                            <td>
                                <form action="<?= $_SERVER['PHP_SELF']; ?>" class="request-btn" method="POST">
                                    <input type="hidden" name="part_id" value="<?= $part->id; ?>">
                                    <input type="hidden" name="part_status" value="<?= $part->status === 'instock'?'outofstock': 'instock'; ?>">
                                    <input type="submit" name="change_status" value="Change Status">
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>
    </div>
</body>
</html>