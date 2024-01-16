<?php
    require('../db/dbconnect.php');
    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        $user = array(
            'username' => $_POST['username'],
            'password' => $_POST['password'],
            'email' => $_POST['email'],
            'mobile' => $_POST['mobile'],
            'address' => $_POST['address'],
            'gender' => $_POST['gender'],
            'cpass' => $_POST['cpassword']
        );
        $user_count =$pdo->query("SELECT COUNT(*) AS count FROM users WHERE email = '$user[email]'")->fetchAll();
        // print_r($user_count);
        $user_exists = $user_count[0]->count == 1;
        if($user['password'] === $user['cpass'] && !$user_exists){
            unset($user['cpass']);
            if($insert_user->execute($user)){
                header('Location: ../index.php');
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
    <title>Register | Create Account</title>
    

    <?php require('../inc/globals.php'); ?>

    <link rel="stylesheet" href="css/user-register.css">

</head>

<body>
    <?php require('../inc/header.php'); ?>
    <div class="body">
        <div class="container">
            <div class="title">Registration</div>
            <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST">
                <div class="user-details">
                    <div class="input-box">
                        <span class="details">Username</span>
                        <input title="Username cannot exceed 15 characters" pattern="[a-zA-Z0-9@-_*&$#!]{2,15}" type="text" placeholder="Enter your username" name="username" required>
                        
                    </div>

                    <div class="input-box">
                        <span class="details">Email</span>
                        <input title="Email should be valid" pattern="[a-zA-Z0-9+-_]+@[a-zA-Z0-9-_+]+\.[a-zA-Z]{2,}" type="email" placeholder="Enter your email" name="email" required>
                    </div>

                    <div class="input-box">
                        <span class="details">Phone Number</span>
                        <input title="Number should be 10 digits" pattern="\d{10}" type="tel" placeholder="Enter your number" name="mobile" required>
                    </div>

                    <div class="input-box">
                        <span class="details">Password</span>
                        <input title="Password must be 8 characters" pattern="[a-zA-Z0-9]{8,}" type="password" placeholder="Enter your password" name="password" required>
                    </div>

                    <div class="input-box">
                        <span class="details">Confirm Password</span>
                        <input title="Password must be 8 characters" pattern="[a-zA-Z0-9]{8,}" type="password" placeholder="Confirm your password" name="cpassword" required>
                    </div>

                    <div class="input-box">
                        <span class="details">Address</span>
                        <!-- <textarea name="address" id="" cols="30" rows="10" placeholder="Enter your address"></textarea> -->
                        <input title="Address cannot exceed 100 characters" pattern="[a-zA-z0-9-_,]{2,100}" type="text" placeholder="Enter your address" name="address" required>
                    </div>
                </div>

                <div class="gender-details">
                    <input type="radio" name="gender" value="male" id="dot-1" required>
                    <input type="radio" name="gender" value="female" id="dot-2" required>
                    <span class="gender-title">Gender</span>
                    <div class="category">
                        <label for="dot-1">
                            <span class="dot dot--male"></span>
                            <span class="gender">Male</span>
                        </label>
                        <label for="dot-2">
                            <span class="dot dot--female"></span>
                            <span class="gender">Female</span>
                        </label>
                    </div>
                </div>
                <div class="button">
                    <input type="submit" value="Register">
                </div>
            </form>
        </div>
    </div>
</body>

</html>