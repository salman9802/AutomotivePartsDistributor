<?php
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
?>
<header class="header">
    <a href="index.php" class="logo">
        SKYLINE AUTOMOTIVE
    </a>
    <div class="user">
        <a href="account/cart.php">
            <img src="img/icons/shopping-cart.svg" alt="shopping-cart" class="user__cart">
            <!-- <span class="material-symbols-outlined user__cart" style="margin: 0px 30px;font-size:2.5rem;color:black;">
                shopping_cart_checkout
            </span> -->
        </a>
        <button class="user__account" onclick="toggle_menu()">
            <span class="material-symbols-outlined user__account__circle">account_circle</span>
            <span class="material-symbols-outlined user__account__arrow" id="account-arrow">arrow_drop_down</span>
            <!-- <img src="img/icons/account-circle.svg" alt="account-circle" class="user__account__circle">
                <img src="img/icons/down-arrow.svg" alt="down-arrow" class="user__account__arrow"> -->
        </button>
        <div class="sub-menu-wrap" id="sub-menu">
            <div class="sub-menu">
                <?php if(isset($_SESSION['logged_in']) && ($_SESSION['logged_in'] === true)): ?>
                <div class="user-info">
                    <img class="user-info__img" src="img/icons/account-circle.svg" alt="account-circle">
                    <h3 class="user-info__username"><?php echo $_SESSION['username'] ?></h3>
                </div>
                <hr class="sub-menu__divider">
                <?php endif; ?>

                <!-- <a href="" class="sub-menu__link">
                        <span class="material-symbols-outlined sub-menu__link__img">person</span>
                        <p class="sub-menu__link__text">Account Details</p>
                    </a> -->
                    <a href="account/user-register.php" class="sub-menu__link">
                        <span class="material-symbols-outlined sub-menu__link__img">add</span>
                        <p class="sub-menu__link__text">Add Account</p>
                    </a>
                <?php if(!isset($_SESSION['logged_in']) || ($_SESSION['logged_in'] === false)): ?>
                <a href="account/login.php" class="sub-menu__link">
                    <span class="material-symbols-outlined sub-menu__link__img">login</span>
                    <p class="sub-menu__link__text">Login</p>
                </a>
                <?php endif; ?>
                <?php if(isset($_SESSION['logged_in']) && ($_SESSION['logged_in'] === true)): ?>
                <a href="account/logout.php" class="sub-menu__link">
                    <span class="material-symbols-outlined sub-menu__link__img">logout</span>
                    <p class="sub-menu__link__text">Logout</p>
                </a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</header>