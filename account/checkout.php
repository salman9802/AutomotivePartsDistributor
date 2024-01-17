<?php
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    if (!isset($_SESSION['logged_in']) && $_SESSION['logged_in'] !== true)
        header('Location: user-login.php');

    require('../db/dbconnect.php');
    $user_id = $_SESSION['id'];
    if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['placeOrder'])){
        if($get_cart_details->execute(['user_id' => $user_id])){
            $orders = $get_cart_details->fetchAll();
            // foreach($orders as $order){
            //     if($order->status !== 'instock'){
            //         echo '<div class="placed-order not-success">
            //         <span class="material-symbols-outlined">close</span>Order Cannot be Placed. Items not in Stock</div>';
            //         echo "<script>setTimeout(()=>{window.location.href='index.php'}, 2000);</script>";
            //         $out_of_stock = true;
            //     }
            // }
            // if(!$out_of_stock)
                if($remove_from_cart->execute(["user_id" => $user_id])){
                        foreach($orders as $order){
                            $add_sale->execute([$user_id, $order->id, $order->quantity]);
                        }
                        echo '<div class="placed-order">
                        <span class="material-symbols-outlined">done</span>Order Placed Successfully</div>';
                        echo "<script>setTimeout(()=>{window.location.href='index.php'}, 2000);</script>";
                    }
            }
        }
    if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['checkout'])){
            $grand_total = $_POST['checkout_gt'];
            $index = 1;
            if($get_cart_details->execute(['user_id' => $user_id])){
                $details = $get_cart_details->fetchAll(PDO::FETCH_ASSOC);
                if($get_user->execute(['id' => $_SESSION['id']])){
                    $user = $get_user->fetch();
                    $name = $user->username;
                    $address = $user->address;
                }
            }
        }
    if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['buynow'])){
        $details = [[
            'brand' => $_POST['buy-brand'],
            'name' => $_POST['buy-name'],
            'model' => $_POST['buy-model'],
            'price' => $_POST['buy-price'],
            'quantity' => 1
        ]];
        $grand_total = $_POST['buy-price'];
        $index = 1;
        if($get_user->execute(['id' => $_SESSION['id']])){
            $user = $get_user->fetch();
            $name = $user->username;
            $address = $user->address;
        }
    }
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Skyline Autmotive | Checkout</title>

    <?php require('../inc/globals.php'); ?>

    <link rel="stylesheet" href="css/checkout.css">

    <script src="js/checkout.js" defer></script>

    <style type="text/css" media="print">
        div:not(.invoice) { display: none; }
    </style>
</head>
<body>
    <!-- <div class="placed-order">
    <span class="material-symbols-outlined">done</span>Order Placed Successfully
    </div> -->
    <?php if(isset($details)): ?>
        <div id="invoice" class="invoice">
            <table id="invoiceTable" class="invoice__table">
                <thead>
                    <caption>Invoice</caption>
                    <tr>
                        <th>#</th>
                        <th>Brand</th>
                        <th>Model</th>
                        <th>Name</th>
                        <th>Price</th>
                        <th>Quantity</th>
                    </tr>
                </thead>
                <tbody>
                        <?php foreach($details as $order): ?>
                            <tr>
                                <td><?php echo $index++; ?></td>
                                <td><?php echo $order['brand']; ?></td>
                                <td><?php echo $order['model']; ?></td>
                                <td><?php echo $order['name']; ?></td>
                                <td><span class="rupee">&#8377;</span><?php echo $order['price']; ?></td>
                                <td><?php echo $order['quantity']; ?></td>
                            </tr>
                        <?php endforeach; ?>
                        <tr>
                            <td class="invoice__amount amount--text" colspan="4">Amount</td>
                            <td class="invoice__amount amount--value" colspan="2"><span class="rupee">&#8377;</span><?php echo $grand_total; ?></td>
                        </tr>
                        <tr>
                            <td class="invoice__info" colspan="3">Customer Name</td>
                            <td class="invoice__info" colspan="3"><?php echo !isset($name)?: $name; ?></td>
                        </tr>
                        <tr>
                            <td class="invoice__info" colspan="3">Delivery Address</td>
                            <td class="invoice__info" colspan="3"><?php echo !isset($address)?: $address; ?></td>
                        </tr>
                </tbody>
            </table>
            <div class="invoice__actions">
                <a id="btn-back" class="invoice__btn" href="account/cart.php"><span class="material-symbols-outlined">arrow_back</span>Back</a>
                <!-- <a class="invoice__btn" onclick="window.print();">Place Order & Print Invoice</a> -->
                <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" id="order-form">
                    <!-- <button name="placeOrder" class="invoice__btn" onclick="window.print();">Place Order & Print Invoice</button> -->
                    <button name="placeOrder" class="invoice__btn" onclick="orderInvoice(document.getElementsByTagName('html')[0])">Place Order & Print Invoice</button>
                </form>
                <!-- <a class="invoice__btn" onclick="print_invoice();">Place Order & Print Invoice</a> -->
                <!-- <a id="btn-print" class="invoice__btn" href="javascript:document.getElementById('btn-back').style.display='none';document.getElementById('btn-print').style.display='none';window.print();">Place Order & Print Invoice</a> -->
            </div>
        </div>
    <?php endif; ?>
</body>
</html>