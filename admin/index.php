<?php
    if(isset($_SESSION['alogged_in']) && $_SESSION['alogged_in'] === true)
        header('Location: ../admin/admin.php');
    require('../db/dbconnect.php');
    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        $admin = [
            'aname' => $_POST['aname'],
            'apass' => $_POST['apass']
        ];
        if($search_admin->execute($admin)){
            $result = $search_admin->fetchAll();
            if(count($result) == 1){
                session_start();
                $_SESSION['aid'] = $result[0]->id;
                $_SESSION['aname'] = $result[0]->name;
                $_SESSION['alogged_in'] = true;
                header('Location: ../admin/admin.php');
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
    <?php //require('../inc/header.php'); ?>
    <div class="body">
        <div class="container">
            <div class="title">Admin Login</div>
            <form action="<?= $_SERVER['PHP_SELF']; ?>" method="POST">
                <div class="user-details">
                    <div class="input-box">
                        <span class="details">Name</span>
                        <input title="Enter valid id" type="text" placeholder="Enter your name" name="aname" pattern="[a-z0-9_]{2,}" required>
                    </div>

                    <div class="input-box">
                        <span class="details">Password</span>
                        <input title="Password must be 8 characters" pattern="[a-z0-9_]{5,}" type="password" placeholder="Enter your password" name="apass" required>
                    </div>

                </div>
                <div class="button">
                    <input type="submit" value="Login">
                </div>
            </form>
        </div>
    </div>
    <?php //require('../inc/footer.php'); ?>
</body>

</html>