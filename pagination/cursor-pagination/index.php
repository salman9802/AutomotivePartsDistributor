<?php
    require('../../db/dbconnect.php');

    $first_part_id = $pdo->query("SELECT * FROM parts ORDER BY id ASC LIMIT 1")->fetch()->id;
    $last_part_id = $pdo->query("SELECT * FROM parts ORDER BY id DESC LIMIT 1")->fetch()->id;
    
    $limit = 10; // Amount of parts on a single page
    $cursor = $first_part_id;// id of reference element [id of 1st for previous & id of last for next]
    
    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        if(isset($_POST['prev-btn'])){
            $cursor = $_POST['prev-cursor'];
            // Reverse array as it returns reversed array
            $parts = array_reverse($pdo->query("SELECT * FROM parts WHERE id < " . $cursor . " ORDER BY id DESC LIMIT " . $limit)->fetchAll());
            $first_cursor = reset($parts)->id;
            $last_cursor = end($parts)->id;
        }
        else if(isset($_POST['next-btn'])){
            $cursor = $_POST['next-cursor'];
            $parts = $pdo->query("SELECT * FROM parts WHERE id > " . $cursor . " LIMIT " . $limit)->fetchAll();
            $first_cursor = reset($parts)->id;
            $last_cursor = end($parts)->id;
        }
    }else {
        $parts = $pdo->query("SELECT * FROM parts LIMIT " . $limit)->fetchAll();
        $first_cursor = reset($parts)->id;
        $last_cursor = end($parts)->id;
    }
    // echo '<br>';
    // var_dump($cursor);
    // echo '<br>';
    // echo $first_cursor;
    // echo '<br>';
    // echo $last_cursor;
    // echo '<pre>';
    // print_r($parts);
    // echo '</pre>';
    // exit;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Skyline Automative - Car Parts Distributor</title>

    <?php require('../../inc/globals.php'); ?>

    <link rel="stylesheet" href="css/part-search.css">
    <link rel="stylesheet" href="pagination/offset-pagination/pagination.css">
</head>
<body>
    <!-- Source - https://itnext.io/the-best-database-pagination-technique-is-530abf2aab51 -->
    <?php require('../../inc/header.php'); ?>
    <div class="search-section">
        
        <div class="search__results">
            <div class="result-grid">
                <?php if(isset($parts)): ?>
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
                    <?php endif; ?>
            </div>
            <?php if(isset($parts)): ?>
                <form action="<?=$_SERVER['PHP_SELF'] ?>" id="pagination-form" method="POST">
                    <div class="pagination-btns">
                        <input id="prev-btn" name="prev-btn" <?= $first_cursor == $first_part_id ? 'disabled' : ''?> type="submit" value="&larr; Previous"></input>
                        <!-- <span><span id="page-number"><?= $current_page?></span> Of <span id="page-count"><?= $last_page?></span></span> -->
                        <input id="next-btn" name="next-btn" <?= $last_cursor == $last_part_id ? 'disabled' : ''?> value="Next &rarr;" type="submit"></input>
                    </div>
                    <input type="hidden" name="prev-cursor" value="<?= reset($parts)->id?>">
                    <input type="hidden" name="next-cursor" value="<?= end($parts)->id?>">
                </form>
            <?php endif; ?>
        </div>
    </div>
    <?php require('../../inc/footer.php'); ?>
</body>

</html>