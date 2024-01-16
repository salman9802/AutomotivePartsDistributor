<?php
    // if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] === false) {
    //     header('Location: ../index.php');
    // }
    require('../db/dbconnect.php');
    // $brand = 'mahindra';
    // $model = 'alfa';
    // $part = 'engine';
    if($_SERVER['REQUEST_METHOD'] === 'GET'){
        $selected_brand = $_GET['brand'];
        $selected_model = $_GET['model'];
        $selected_part = $_GET['part'];
        $get_parts->execute(['brand' => $selected_brand, 'model' => $selected_model, 'part' => $selected_part]);
        $parts = $get_parts->fetchAll();
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Skyline Automative - Car Parts Distributor</title>

    <?php require('../inc/globals.php'); ?>

    <link rel="stylesheet" href="css/part-search.css">
</head>
<body>
    <?php require('../inc/header.php'); ?>
    <div class="search-section">
        <div class="search__title">
            Parts for
            <span class="part">
            <?php echo $selected_brand ?> <?php echo $selected_model ?> <?php echo $selected_part ?>
            </span>
        </div>
        <div class="search__results">
            <div class="result-grid">
                <?php foreach($parts as $part): ?>
                    <div class="part-card">
                        <a href="parts/part-detail.php?part_id=<?php echo "$part->id" ?>" class="part__link">
                            <!-- <div class="part__stock"></div> -->
                            <div class="part__stock"><?php echo $part->status=='instock'?'':'Out of Stock' ?></div>
                            <!-- <?php echo $part->image ?> -->
                            <img class="part__img" src="<?php echo $part->image ?>" alt="tata-engine">
                            <div class="part__desc">
                                <h3 class="part__name"><?php echo $part->name ?></h3>
                                <span class="part__brand">Brand: <?php echo $part->brand ?></span>
                                <span class="part__model">Model: <?php echo $part->model ?></span>
                                <span class="part__price"><span>&#8377;</span><?php echo $part->price ?></span>
                            </div>
                            <div class="part__action">
                                <a href="parts/part-detail.php?part_id=<?php echo "$part->id" ?>"><button class="part__btn buy--btn">View Details</button></a>
                                <!-- <a href=""><button class="part__btn cart--btn">Add to Cart</button></a> -->
                                <?php if($part->status === 'instock'): ?>
                                    <form action="account/cart.php" method="POST">
                                        <input type="hidden" name="part_id" value="<?php echo $part->id ?>">
                                        <input class="part__btn cart--btn" type="submit" value="Add To Cart">
                                    </form>
                                <?php endif; ?>
                            </div>
                        </a>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
    <?php require('../inc/footer.php'); ?>
</body>

</html>