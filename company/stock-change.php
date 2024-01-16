<?php
    if (session_status() === PHP_SESSION_NONE) 
        session_start();
    if (!isset($_SESSION['clogged_in']) && $_SESSION['clogged_in'] !== true)
        header('Location: ../account/company-login.php');
    require('../db/dbconnect.php');
    $cid = $_SESSION['cid'];
    /*
    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        if(isset($_POST['change_status'])){
            $part_id = $_POST['part_id'];
            $status = $_POST['part_status'] === 'instock'? 'outofstock' : 'instock';
            if($change_status->execute(['status' => $status, 'part_id' => $part_id])){
                // echo "<script>alert('Successfully Changed Status');</script>";
            }
        }
    }
    */
    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        if(isset($_POST['change_status'])){
            $part_id = $_POST['part_id'];
            if($get_status->execute(['part_id' => $part_id])){
                $part = $get_status->fetch();
                // $request = $part->request === true ? false : true; // This won't work
                $request = $part->request === 1 ? 0 : 1;
                if($change_request->execute(['request' => $request, 'part_id' => $part_id])){
                    echo "<script>alert('Request Successfully Made');</script>";
                }
            }
        }
    }
    if($manage_parts->execute(['company_id' => $cid])){
        $parts = $manage_parts->fetchAll();
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Skyline Automotive | Request Stock Change</title>

    <?php require('../inc/globals.php'); ?>

    <link rel="stylesheet" href="css/company-header.css">
    <link rel="stylesheet" href="css/stock-change.css">
</head>
<body>
<?php require('header.php'); ?>

    <div class="stock-change">
        <?php if(isset($parts)): ?>
            <table class="stock__table">
                <thead>
                    <caption>Request Stock Change</caption>
                    <tr>
                        <th>Part Id</th>
                        <th>Part Model</th>
                        <th>Part Name</th>
                        <th>Stock Status</th>
                        <th>Request to</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($parts as $part) :?>
                        <tr>
                            <td><?= $part->id; ?></td>
                            <td><?= $part->model; ?></td>
                            <td><?= $part->name; ?></td>
                            <td><?= $part->status; ?></td>
                            <td>
                                <form action="<?= $_SERVER['PHP_SELF']; ?>" class="request-btn" method="POST">
                                    <input type="hidden" name="part_id" value="<?= $part->id; ?>">
                                    <input type="hidden" name="part_status" value="<?= $part->status; ?>">
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