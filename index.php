<?php
    require('db/dbconnect.php'); // Connect to db
    if(isset($_GET['brand'])){ // When Brand is selected
        $selected_brand = $_GET['brand'];
        $get_models->execute(['brand' => $selected_brand]);
        $models = $get_models->fetchAll();
        if(isset($_GET['model'])){ // when Model is selected
            $selected_model = $_GET['model'];
            if(isset($_GET['part'])){ // when Part is selected
                $selected_part = $_GET['part'];
                header("Location: parts/part-search.php?brand=$selected_brand&model=$selected_model&part=$selected_part");
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
    <title>Skyline Automative - Automotive Parts Distributor</title>

    <!-- <base href='http://localhost/CollegeProject/AutomotivePartsDistributor/'> -->
    <!--
    <?php
    //  $path = $_SERVER['SERVER_NAME'] == 'localhost' ? '/' : 'http://localhost/CollegeProject/AutomotivePartsDistributor/'; 
    //  $path = $_SERVER['SERVER_NAME'] == 'localhost' ? '/' : '..'; 
    $path = "http://localhost/CollegeProject/AutomotivePartsDistributor/";
    echo "<base href='$path'>";
    ?>
    -->

    <?php require('inc/globals.php'); ?>

    <link rel="stylesheet" href="css/index.css">
</head>

<body>
    <?php require('inc/header.php'); ?>
    <div class="search-section">
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" class="search" method="GET">
            <select name="brand" id="" class="search__element search--box" onchange="this.form.submit();" required>
                <option value="" selected disabled hidden>Select Brand</option>
                <?php foreach($brands as $brand): ?>
                <option value="<?php echo $brand->brand ?>" <?php echo (!isset($selected_brand)) ?:$selected_brand != $brand->brand?:'selected' ?>><?php echo $brand->brand ?></option>
                <?php endforeach; ?>
            </select>
            <select name="model" id="" class="search__element search--box" onchange="this.form.submit();" required>
                <option value="" selected disabled hidden>Select Model</option>
                <?php if(isset($models)): ?>
                    <?php foreach($models as $model): ?>
                        <option value="<?php echo$model->model ?>" <?php echo (!isset($selected_model)) ?:$selected_model != $model->model?:'selected' ?> ><?php echo$model->model ?></option>
                    <?php endforeach; ?>
                <?php endif; ?>
            </select>
            <select name="part" id="" class="search__element search--box" required>
                <option value="" selected disabled hidden>Select Part</option>
                <?php foreach($parts as $part): ?>
                <option value="<?php echo $part ?>"><?php echo $part ?></option>
                <?php endforeach; ?>
            </select>
            <input type="submit" name="search" value="Search" class="search__element search--btn">
        </form>
    </div>
    <div class="feature-section">
        <div class="feature">
            <img src="img/icons/dollar.svg" alt="dollar" class="feature__img">
            <h3 class="feature__title">Affordable Rates</h3>
            <div class="feature__desc">
                Parts are directly from the manufacturers, making them cheaper.
            </div>
        </div>

        <div class="feature">
            <img src="img/icons/timer.svg" alt="timer" class="feature__img">
            <h3 class="feature__title">Saving Time</h3>
            <div class="feature__desc">
                Parts from different manufacturers available in one place. No need to waste time finding what you need.
            </div>
        </div>

        <div class="feature">
            <img src="img/icons/verified.svg" alt="original" class="feature__img">
            <h3 class="feature__title">Original Products</h3>
            <div class="feature__desc">
                Original Parts directly from manufacturers.
            </div>
        </div>
    </div>
    <div class="brand">
        <h3 class="brand__heading">Our OEM Brands</h3>
        <div class="brand-grid">
            <div class="brand-grid-item">
                <img src="img/logo/porsche-logo.svg" alt="porsche-logo" class="brand__img">
            </div>
            <div class="brand-grid-item">
                <img src="img/logo/tesla-logo.svg" alt="tesla-logo" class="brand__img">
            </div>
            <div class="brand-grid-item">
                <img src="img/logo/tata-motors-logo.svg" alt="tata-motors-logo" class="brand__img">
            </div>
            <div class="brand-grid-item">
                <img src="img/logo/mahindra-logo.svg" alt="mahindra-logo" class="brand__img">
            </div>
            <div class="brand-grid-item">
                <img src="img/logo/kia-logo.svg" alt="kia-logo" class="brand__img">
            </div>
            <div class="brand-grid-item">
                <img src="img/logo/toyota-logo.svg" alt="toyota-logo" class="brand__img">
            </div>
            <div class="brand-grid-item">
                <img src="img/logo/hyundai-logo.svg" alt="hyundai-logo" class="brand__img">
            </div>
            <div class="brand-grid-item">
                <img src="img/logo/maruti-suzuki-logo.svg" alt="maruti-suzuki-logo" class="brand__img">
            </div>
        </div>
    </div>
    <footer class="footer">
        <div class="footer-wrap">
            <div class="footer__address">
                <h3 class="address__heading">Skyline Automative</h3>
                <p class="address__content">
                    1<sup>st</sup> Floor ABS Building, Acenter<br>Europia, Atlas 121454.
                </p>
            </div>
            <div class="footer__info">
                <div class="info info--email">
                    <p class="info-title">Email:</p>
                    <p class="info-desc">email@example.com</p>
                </div>
                <div class="info info--contact">
                    <p class="info-title">Contact:</p>
                    <p class="info-desc">1597534862</p>
                </div>
                <div class="info info--time">
                    <p class="info-title">Work Time:</p>
                    <p class="info-desc">Everyday 10AM-10PM</p>
                </div>
            </div>
        </div>
        <?php include('inc/footer.php'); ?>
    </footer>
</body>

</html>