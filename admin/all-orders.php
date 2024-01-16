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
    <link rel="stylesheet" href="css/all-orders.css">
</head>
<body>
    <?php require('header.php'); ?>
    <?php if(isset($customers)  && count($customers) > 0): ?>
        <div class="business-summary">
            <table class="summary__table">
                <thead>
                    <caption>Orders</caption>
                    <tr>
                        <th>Customer Id</th>
                        <th>Date & Time</th>
                        <th>Customer Name</th>
                        <th>Delivery Address</th>
                        <th>Mobile No.</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($customers as $customer): ?>
                        <tr>
                            <td><?= $customer->id; ?></td>
                            <td><?= $customer->timestamp; ?></td>
                            <td><?= $customer->name; ?></td>
                            <td><?= $customer->address; ?></td>
                            <td><?= $customer->mobile; ?></td>
                            <td>
                                <form class="action-btn" action="admin/view-customer.php" method="POST">
                                    <input type="hidden" value="<?= $customer->id; ?>" name="id">
                                    <input type="hidden" value="<?= $customer->timestamp; ?>" name="timestamp">
                                    <input type="hidden" value="<?= $customer->name; ?>" name="name">
                                    <input type="hidden" value="<?= $customer->mobile; ?>" name="mobile">
                                    <input type="hidden" value="<?= $customer->address; ?>" name="address">
                                    <input type="submit" value="View Details" name='submit'>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php endif; ?>
</body>
</html>