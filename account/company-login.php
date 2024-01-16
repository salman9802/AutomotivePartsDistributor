<?php
    require('../db/dbconnect.php');
    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        $company = [
            'cid' => $_POST['cid'],
            'cpass' => $_POST['cpass']
        ];
        if($search_company->execute($company)){
            $result = $search_company->fetchAll();
            // print_r($result);
            // exit;
            if(count($result) == 1){
                session_start();
                $_SESSION['cid'] = $result[0]->id;
                $_SESSION['cname'] = $result[0]->name;
                $_SESSION['clogged_in'] = true;
                header('Location: ../company/index.php');
            }else{
                echo "<script>alert('Invalid Credentials');</script>";
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
    <title>Login</title>

    <?php require('../inc/globals.php'); ?>

    <link rel="stylesheet" href="css/company-login.css">

</head>

<body>
    <?php require('../inc/header.php'); ?>
    <div class="body">
        <div class="container">
            <div class="title">Company Login</div>
            <form action="<?= $_SERVER['PHP_SELF']; ?>" method="POST">
                <div class="user-details">
                    <div class="input-box">
                        <span class="details">Company ID</span>
                        <input title="Enter valid id" type="text" placeholder="Enter your company id" name="cid" pattern="[a-z0-9_]{2,}" required>
                    </div>

                    <div class="input-box">
                        <span class="details">Password</span>
                        <input title="Password must be 8 characters" pattern="[a-z0-9_]{8,}" type="password" placeholder="Enter your password" name="cpass" required>
                    </div>

                </div>
                <div class="button">
                    <input type="submit" value="Login">
                </div>
            </form>
        </div>
    </div>
    <?php require('../inc/footer.php'); ?>
</body>

</html>