<?php
    if (session_status() === PHP_SESSION_NONE) 
        session_start();
    if (!isset($_SESSION['clogged_in']) && $_SESSION['clogged_in'] !== true)
        header('Location: ../account/company-login.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Skyline Automotive | Company login</title>

    <?php require('../inc/globals.php'); ?>

    <link rel="stylesheet" href="css/company-header.css">
    <link rel="stylesheet" href="css/company-index.css">
</head>
<body>
    <?php require('header.php'); ?>

    <div class="control__title">Company Controls</div>
    <div class="company-controls">
        <div class="company__control stock-change">
<!-- <a href="https://www.flaticon.com/free-icons/boxes" title="boxes icons">Boxes icons created by Freepik - Flaticon</a> -->
            <img class="control__img" src="img/icons/stock.png" alt="Stock Image">
            <div>
                <!-- <form action="<?= $_SERVER['PHP_SELF']; ?>">
                    <input class="control__link" type="submit" value="Request Stock Change">
                </form> -->
                <a href="company/stock-change.php" class="control__link">Request Stock Change</a>
            </div>
        </div>
        <div class="company__control view-sale">
<!-- <a href="https://www.flaticon.com/free-icons/stock" title="stock icons">Stock icons created by ultimatearm - Flaticon</a> -->
            <img class="control__img" src="img/icons/sale.png" alt="Sale Image">
            <div>
            <!-- <form action="<?= $_SERVER['PHP_SELF']; ?>">
                    <input class="control__link" type="submit" value="View Sale">
                </form> -->
                <a href="company/view-sale.php" class="control__link">View Sale</a>
            </div>
        </div>
    </div>
</body>
</html>