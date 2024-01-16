<?php
if (!isset($_GET['part_id']))
    header("Location: ../index.php");
else {
    require('../db/dbconnect.php');
    $part_id = $_GET['part_id'];
    $get_part->execute(['id' => $part_id]);
    $part = $get_part->fetch();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Skyline Automative - Automotive Parts Distributor</title>

    <?php require('../inc/globals.php'); ?>

    <link rel="stylesheet" href="css/part-detail.css">
</head>

<body>
    <?php require('../inc/header.php'); ?>
    <div class="part">
        <?php if(isset($part)): ?>
            <div class="part__lhs">
                <!-- <img src="img/parts/tata/ace/engine/tata-engine.webp" alt="" class="part__img"> -->
                <img src="<?php echo $part->image; ?>" alt="" class="part__img">
            </div>
            <div class="part__rhs">
                <div class="part__name"><?php echo $part->name; ?></div>
                <div class="part__details">
                    <div class="part__brand"><span>Brand: </span> <?php echo $part->brand; ?></div>
                    <div class="part__model"><span>Model: </span> <?php echo $part->model; ?></div>
                    <div class="part__type"><span>Type: </span> <?php echo $part->type; ?></div>
                </div>
                <div class="part__price"><span>&#8377;</span><?php echo $part->price ?></div>
                <div class="part__status <?php echo $part->status === 'instock'?:'outofstock' ?>"><?php echo $part->status === 'instock'? 'The Current Product is in Stock' :'The Current Product is out of Stock. Save to Cart' ?></div>
                <?php if($part->status === 'instock'): ?>
                    <div class="part__action">
                        <form action="account/cart.php" method="POST">
                            <input type="hidden" name="part_id" value="<?php echo $part->id ?>">
                            <input class="part__btn" type="submit" value="Add To Cart">
                        </form>
                            <form action="account/checkout.php" method="POST">
                                <input type="hidden" name="buy-brand" value="<?= $part->brand; ?>">
                                <input type="hidden" name="buy-name" value="<?= $part->name; ?>">
                                <input type="hidden" name="buy-price" value="<?= $part->price; ?>">
                                <input type="hidden" name="buy-model" value="<?= $part->model; ?>">
                                <!-- <input type="hidden" name="buy-quantity" value="1"> -->
                                <!-- <button class="checkout__btn" name="checkout" type="submit">Checkout</button> -->
                                <input class="part__btn" name="buynow" type="submit" value="Buy Now">
                            </form>
                    </div>
                <?php endif; ?>
            </div>
        <?php endif; ?>
    </div>
    <?php require('../inc/footer.php'); ?>
</body>

</html>