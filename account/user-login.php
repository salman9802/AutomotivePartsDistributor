<?php
    require('../db/dbconnect.php');
    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        $user = [
            'email' => $_POST['email'],
            'password' => $_POST['password']
        ];
        if($search_user->execute($user)){
            $result = $search_user->fetchAll();
            if(count($result) == 1){
                session_start();
                $_SESSION['id'] = $result[0]->id;
                $_SESSION['username'] = $result[0]->username;
                $_SESSION['email'] = $user['email'];
                $_SESSION['logged_in'] = true;
                header('Location: ../index.php');
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

    <link rel="stylesheet" href="css/user-login.css">

</head>

<body>
    <?php require('../inc/header.php'); ?>
    <div class="body">
        <div class="container">
            <div class="title">User Login</div>
            <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
                <div class="user-details">
                    <div class="input-box">
                        <span class="details">Email</span>
                        <input title="Email should be valid" pattern="[a-zA-Z0-9+-_]+@[a-zA-Z0-9-_+]+\.[a-zA-Z]{2,}" type="email" placeholder="Enter your email" name="email" required>
                    </div>

                    <div class="input-box">
                        <span class="details">Password</span>
                        <input title="Password must be 8 characters" pattern="[a-zA-Z0-9]{8,}" type="password" placeholder="Enter your password" name="password" required>
                    </div>

                </div>
                <div class="button">
                    <input type="submit" value="Login">
                </div>
                <div class="create-account">
                    <span>
                        No Acccount?&nbsp;<a href="account/user-register.php">Create One</a>
                    </span>
                </div>
            </form>
        </div>
    </div>
    <?php require('../inc/footer.php'); ?>
</body>

</html>