<?php
    if (session_status() === PHP_SESSION_NONE) 
        session_start();
    if (!isset($_SESSION['alogged_in']) && $_SESSION['alogged_in'] !== true)
        header('Location: ../admin');
    require('../db/dbconnect.php');

    if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])){
        $user_id = $_POST['id'];
        $timestamp = $_POST['timestamp'];
        // $timestamp = substr($timestamp, 0, strlen($timestamp)-3);
        // echo $timestamp;
        // echo "<br>";
        // echo date("Y-m-d H:i:", strtotime($_POST['timestamp']));
        // exit;
        // date("Y-m-d H:i:s", strtotime($_POST['timestamp']));

        // if($get_orders->execute(['user_id' => $user_id])){
        // if($get_orders->execute([$user_id, date("Y-m-d H:i:", strtotime($_POST['timestamp']))])){
        // if($get_orders->execute(['user_id' => $user_id, 'timestamp' => date("Y-m-d H:i:", strtotime($_POST['timestamp']))])){
        // if($get_orders->execute(['user_id' => $user_id, 'timestamp' => date("Y-m-d H:i", strtotime($timestamp))])){
        // if($get_orders->execute([$user_id, strtotime($timestamp)])){
            if($get_orders->execute([$user_id, date($timestamp)])){
            $orders = $get_orders->fetchAll();
            $total_cost = 0;
        }
    }
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
    <?php if(isset($_POST['submit'])): ?>
    <div class="business-summary">
            <table class="summary__table">
                <thead>
                    <caption>Order Details</caption>
                </thead>
                <tbody>
                    <tr>
                        <th>Date & Time</th>
                        <td><?= $_POST['timestamp']; ?></td>
                    </tr>
                    <tr>
                        <th>Customer Name</th>
                        <td><?= $_POST['name']; ?></td>
                    </tr>
                    <tr>
                        <th>Mobile Number</th>
                        <td><?= $_POST['mobile']; ?></td>
                    </tr>
                    <tr>
                        <th>Delivery Address</th>
                        <td><?= $_POST['address']; ?></td>
                    </tr>
                </tbody>
            </table>
        <?php endif; ?>
        <?php if(isset($orders) && count($orders) > 0): ?>
            <table class="summary__table">
                <thead>
                    <caption>Orders</caption>
                </thead>
                <tbody>
                    <tr>
                        <th>Brand</th>
                        <th>Model</th>
                        <th>Name</th>
                        <th>Price</th>
                        <th>Quantity</th>
                    </tr>
                    <?php foreach($orders as $order): ?>
                        <?php $total_cost += ($order->price * $order->quantity);?>
                        <tr>
                            <td><?= $order->brand; ?></td>
                            <td><?= $order->model; ?></td>
                            <td><?= $order->name; ?></td>
                            <td><span>&#8377;</span><?= $order->price; ?></td>
                            <td><?= $order->quantity; ?></td>
                        </tr>
                    <?php endforeach; ?>
                    <tr>
                        <td colspan="3">Total Amount</td>
                        <td colspan="2"><span>&#8377;</span><?= $total_cost; ?></td>
                    </tr>
                </tbody>
            </table>
            <a id="printBtn" href="javascript:window.print();">Print</a>
        <?php endif; ?>
    </div>
    
</body>
</html>