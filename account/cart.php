<?php
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    if (!isset($_SESSION['logged_in']) && $_SESSION['logged_in'] !== true)
        header('Location: user-login.php');

    require('../db/dbconnect.php');
    if(!isset($grand_total))
        $grand_total = 0;

    // for($i=0;$i<$cart_count;$i++){
    //     $grand_total += $cart_items[$i]['quantity'] * $cart_items[$i]['price'];
    // }
    // Add Item in Cart
    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        if(isset($_POST['part_id']))
            if($in_cart->execute(['user_id' => $_SESSION['id'], 'part_id' => $_POST['part_id']])){
                if($in_cart->fetch()->count == 0)
                    $insert_part->execute(['user_id' => $_SESSION['id'], 'part_id' => $_POST['part_id']]);
            }
    }

    // Remove Item from Cart
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['remove'])) {
        if(!($remove_item->execute(["user_id" => $_POST['remove_uid'], "part_id" => $_POST['remove_pid']]))){
            die("Unable to remove item");
        }
    }

    // Get Cart Items
    if($get_cart_items->execute(["user_id" => $_SESSION['id']])){
        $cart_items = $get_cart_items->fetchAll(PDO::FETCH_ASSOC);
        $cart_count = count($cart_items);

        // Add Quantity for items
        for($i=0;$i<$cart_count;$i++){
            $get_quantity->execute([$_SESSION['id'], $cart_items[$i]['id']]);
            $cart_items[$i] += ['quantity' => $get_quantity->fetch()->quantity];
            $grand_total += $cart_items[$i]['quantity'] * $cart_items[$i]['price'];
        }
        // print_r($grand_total);

        // Update Quantity
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if(isset($_POST['index'])){
                if($update_quantity->execute(['quantity' => $_POST['quantity'], 'user_id' => $_SESSION['id'], 'part_id' => $_POST['part_id']])){
                    $cart_items[$_POST['index']]['quantity'] = $_POST['quantity'];
                    // Update grand total
                    global $grand_total;
                    $grand_total = 0;
                    for($i=0;$i<$cart_count;$i++){
                        $grand_total += $cart_items[$i]['quantity'] * $cart_items[$i]['price'];
                    }
                }
            }
        }
    }

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Cart</title>

    <?php require('../inc/globals.php'); ?>

    <link rel="stylesheet" href="css/cart.css">
</head>

<body>
    <?php require('../inc/header.php'); ?>
    <div class="cart">
        <div class="cart__title">Your Cart [<?php echo $cart_count; ?> items]</div>
        <?php if ($cart_count == 0) : ?>
            <div class="cart__empty">
                <!-- <div class="empty-cart-img">
                    <img src="img/img/empty-cart.png" alt="Empty Cart">
                </div> -->
                <img src="img/img/empty-cart.png" alt="Empty Cart" class="empty-cart-img">
                <div class="empty-cart-title">
                    Your cart is empty.
                </div>
                <div class="empty-cart-desc">
                    Looks like you have not added anything to your cart. Go ahead and buy something.
                </div>
            </div>
        <?php endif; ?>

        <?php if($cart_count > 0): ?>
            <table class="cart__table">
                <tr class="cart__row">
                    <th class="table__heading">Item</th>
                    <th class="table__heading">Price</th>
                    <th class="table__heading">Quantity</th>
                    <th class="table__heading">Total</th>
                    <th>&nbsp;</th>
                </tr>
                <?php foreach($cart_items as $index => $cart_item): ?>
                    <tr class="cart__row">
                        <td class="item item--product">
                            <img src="<?php echo $cart_item['image'] ?>" alt="" class="item__img">
                            <div class="item__name"><?php echo $cart_item['name']; ?></div>
                        </td>
                        <td class="item">
                            <div class="item__price"><span>&#8377;</span><?php echo $cart_item['price']; ?></div>
                        </td>
                        <td class="item">
                            <div class="item__quantity">
                                <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                                    <input type="hidden" name="part_id" value="<?php echo $cart_item['id'] ?>">
                                    <input type="hidden" name="index" value="<?php echo $index ?>">
                                    <?php //echo isset($cart_item['quantity'])?$cart_item['quantity']:1;?>
                                    <!-- <?php //echo $cart_item['quantity'];?> -->
                                    <input type="number" name="quantity" onchange="this.form.submit();" value="<?php echo isset($cart_item['quantity'])?$cart_item['quantity']:1; ?>" min="1" max="5">
                                    <!-- <input type="number" name="quantity" onchange="this.form.submit();" value="<?php echo isset($cart_item['quantity'])?$cart_item['quantity']:1; ?>" min="1" max="5" onKeypress="event.preventDefault();"> -->
                                </form>
                                <!-- onchange="this.form.submit();"  -->
                                <!-- onKeypress="event.preventDefault();" -->
                            </div>
                        </td>
                        <td class="item">
                            <div class="item__total"><?php echo isset($cart_item['quantity'])?$cart_item['quantity']*$cart_item['price']: $cart_item['price'];?></div>
                        </td>
                        <td class="item">
                            <div class="item__action">
                                <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                                <input type="hidden" name="remove_pid" value="<?php echo $cart_item['id'] ?>">
                                <input type="hidden" name="remove_uid" value="<?php echo $_SESSION['id'] ?>">
                                <button name="remove" type="submit"><span class='material-symbols-outlined'>cancel</span></button>
                                    <!-- <span class='material-symbols-outlined'>cancel</span> -->
                                </form>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>
            <div class="cart__checkout">
            <span class="grand-total">Grand Total:</span>
                <span class="cart__gt"><span>&#8377;</span><?php echo $grand_total; ?></span>
                <form action="account/checkout.php" method="POST">
                    <input type="hidden" name="checkout_gt" value="<?php echo $grand_total ?>">
                    <button class="checkout__btn" name="checkout" type="submit">Checkout</button>
                </form>
            </div>
        <?php endif; ?>
    </div>

    <?php require('../inc/footer.php'); ?>
</body>

</html>