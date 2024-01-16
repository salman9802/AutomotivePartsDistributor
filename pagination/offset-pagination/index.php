<?php
    require('../../db/dbconnect.php');

    // if($_SERVER['REQUEST_METHOD'] === 'GET'){
    //     $selected_brand = $_GET['brand'];
    //     $selected_model = $_GET['model'];
    //     $selected_part = $_GET['part'];
    //     $get_parts->execute(['brand' => $selected_brand, 'model' => $selected_model, 'part' => $selected_part]);
    //     $parts = $get_parts->fetchAll();
    // }

    $current_page = 1; // Initally first page is loaded

    $limit = 10; // Amount of parts on a single page
    $offset = ($current_page - 1) * $limit; // No. of part to start from

    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        if(isset($_POST['prev-btn'])){
            $current_page = $_POST['page-number'] - 1;
            $offset = ($current_page - 1) * $limit;
        }
        else if(isset($_POST['next-btn'])){
            $current_page = $_POST['page-number'] + 1;
            $offset = ($current_page - 1) * $limit;
        }
    }
    // echo $current_page;
    // echo '<br>';
    // echo $offset;

    // $parts = $pdo->query("SELECT * FROM parts LIMIT " . $limit);
    $parts_db = $pdo->query("SELECT * FROM parts LIMIT " . $limit . " OFFSET ".  $offset);
    $parts = $parts_db->fetchAll();
    // echo '<pre>';
    // print_r($parts);
    // echo '</pre>';
    // exit;
    
    $part_count = $pdo->query("SELECT id FROM parts")->rowCount();
    $last_page = ceil($part_count / $limit);
    // $parts = $pdo->query("SELECT id FROM parts")->fetchAll();
    // echo '<pre>';
    // print_r($parts);
    // echo '</pre>';
    // echo '<br>';
    // echo $pdo->query("SELECT id FROM parts")->rowCount();
    // echo $current_page;
    // echo '<br>';
    // echo $part_count;
    // echo '<br>';
    // echo $last_page;
    // echo '<pre>';
    // print_r($_GET);
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
                        <input id="prev-btn" name="prev-btn" <?= $current_page === 1 ? 'disabled' : ''?> type="submit" value="&larr; Previous"></input>
                        <span><span id="page-number"><?= $current_page?></span> of <span id="page-count"><?= $last_page?></span></span>
                        <input id="next-btn" name="next-btn" <?= $current_page == $last_page ? 'disabled' : ''?> value="Next &rarr;" type="submit"></input>
                    </div>
                    <input type="hidden" name="page-number" value="<?= $current_page?>">
                </form>
            <?php endif; ?>
        </div>
    </div>
    <?php require('../../inc/footer.php'); ?>
</body>

</html>