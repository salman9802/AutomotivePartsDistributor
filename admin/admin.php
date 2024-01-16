<?php
    if (session_status() === PHP_SESSION_NONE) 
        session_start();
    if (!isset($_SESSION['alogged_in']) && $_SESSION['alogged_in'] !== true)
        header('Location: ../admin');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Skyline Automotive | Admin login</title>

    <?php require('../inc/globals.php'); ?>

    <link rel="stylesheet" href="css/company-header.css">
    <link rel="stylesheet" href="css/company-index.css">
</head>
<body>
    <?php require('header.php'); ?>

    <div class="control__title">Admin Controls</div>
    <div class="company-controls">
        <div class="company__control stock-change">
            <img class="control__img" src="img/icons/stock.png" alt="Stock Image">
            <div>
                <a href="admin/stock-change.php" class="control__link">Manage Stocks</a>
            </div>
        </div>
        <div class="company__control view-sale">
            <img class="control__img" src="img/icons/summary.png" alt="Sale Image">
            <div>
                <a href="admin/business-summary.php" class="control__link">Business Summary</a>
            </div>
        </div>
        <div class="company__control view-sale">
            <img class="control__img" src="img/icons/sale.png" alt="Sale Image">
            <div>
                <a href="admin/view-sales.php" class="control__link">View Sales</a>
            </div>
        </div>
        <div class="company__control view-sale">
            <img class="control__img" src="img/icons/orders.png" alt="Sale Image">
            <div>
                <a href="admin/all-orders.php" class="control__link">All Orders</a>
            </div>
        </div>
        
    </div>
</body>
</html>