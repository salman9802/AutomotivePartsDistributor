<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>

    <?php require('../inc/globals.php'); ?>

    <link rel="stylesheet" href="css/login.css">
</head>

<body>
    <?php require('../inc/header.php'); ?>
    <div class="register-container">
        <div class="register-wrap">
            <div class="register__title">
                Login
            </div>
            <div class="register__links">
                <a href="account/user-login.php" class="register register--user">
                    User Account
                </a>
                <a href="account/company-login.php" class="register register--company">
                    Company Account
                </a>
            </div>
        </div>
    </div>

    <?php require('../inc/footer.php'); ?>
</body>

</html>