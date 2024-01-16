<?php
    if (session_status() === PHP_SESSION_NONE) 
        session_start();
    if (!isset($_SESSION['alogged_in']) && $_SESSION['alogged_in'] !== true)
        header('Location: ../admin');
    require('../db/dbconnect.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Skyline Automotive | Admin Business Summary</title>

    <?php require('../inc/globals.php'); ?>

    <link rel="stylesheet" href="css/company-header.css">
    <link rel="stylesheet" href="css/view-sale.css">
    <link rel="stylesheet" href="css/business-summary.css">
    <style type="text/css" media="print">
        div:not(.business-summary), #printBtn { display: none; }
    </style>
</head>
<body>
    <?php require('header.php'); ?>
    <div class="business-summary">
        <table class="summary__table">
            <thead>
                <caption>Business Summary</caption>
            </thead>
            <tbody>
                <tr>
                    <th>Registered Users</th>
                    <th><?= $user_count; ?></th>
                </tr>
                <tr>
                    <td>Total Distinct Parts Sold</td>
                    <td><?= $distinct_parts_sold; ?></td>
                </tr>
            </tbody>
        </table>
        <table class="summary__table">
            <thead>
                <caption>Most Sold Parts</caption>
            </thead>
            <tbody>
                <tr>
                    <th>Brand</th>
                    <th>Model</th>
                    <th>Name</th>
                    <th>Price</th>
                    <th>Quantity</th>
                </tr>
                <tr>
                        <td><?= $max_sale_part->brand; ?></td>
                        <td><?= $max_sale_part->model; ?></td>
                        <td><?= $max_sale_part->name; ?></td>
                        <td><span>&#8377;</span><?= $max_sale_part->price; ?></td>
                        <td><?= $max_sale_part->quantity; ?></td>
                    </tr>
            </tbody>
        </table>
        <a id="printBtn" href="javascript:window.print();">Print</a>
    </div>
    
</body>
</html>