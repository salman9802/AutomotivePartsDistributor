<?php
    if (session_status() === PHP_SESSION_NONE) 
        session_start();
    if (!isset($_SESSION['alogged_in']) && $_SESSION['alogged_in'] !== true)
        header('Location: ../admin');
    require('../db/dbconnect.php');
    if($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['brand'])){
        $brand = $_GET['brand'];
        if($get_sales->execute(['brand' => $brand])){
            $sales = $get_sales->fetchAll();
            $total_cost = 0;
        }
    }
    $total_cost = 0;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Skyline Automotive | View Sale</title>

    <?php require('../inc/globals.php'); ?>

    <link rel="stylesheet" href="css/company-header.css">
    <link rel="stylesheet" href="css/view-sale.css">
    <style type="text/css" media="print">
        #printBtn, #cheader, .search { display: none; }
    </style>
</head>
<body>
    
<?php require('header.php'); ?>
    <?php 
        if((!isset($sales)) || count($sales) == 0){
            echo "<script>
                // alert('No Sales yet');
                // window.location.href = 'admin/admin.php';
            </script>";
        }
    ?>
<div class="view-sale">
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" class="search" method="GET">
        <select name="brand" id="" class="search__element search--box" onchange="this.form.submit();" required>
            <option value="" selected disabled hidden>Select Brand</option>
            <?php foreach($brands as $brand): ?>
                <option value="<?php echo $brand->brand ?>"><?php echo $brand->brand ?></option>
                <?php endforeach; ?>
            </select>
        </form>
        
        <?php if((isset($sales)) && count($sales) > 0): ?>
        <table class="sale__table">
            <thead>
                <caption>Sale</caption>
                <tr>
                    <th>Part Id</th>
                    <th>Part Name</th>
                    <th>Quantity Sold</th>
                    <th>Cost</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($sales as $sale): ?>
                    <?php $total_cost += ($sale->quantity * $sale->price); ?>
                    <tr>
                        <td><?= $sale->id; ?></td>
                        <td><?= $sale->name; ?></td>
                        <td><?= $sale->quantity; ?></td>
                        <td><span>&#8377;</span><?= $sale->quantity * $sale->price; ?></td>
                    </tr>
                <?php endforeach; ?>
                <tr>
                   <td colspan="3">Total Cost</td>
                   <td><span>&#8377;</span><?= $total_cost; ?></td>
                </tr>
            </tbody>
        </table>
        <a id="printBtn" href="javascript:window.print();">Print</a>
    <?php endif; ?>
</div>
</body>
</html>