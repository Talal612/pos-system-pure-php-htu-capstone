<?php

use Core\Helpers\Helper; ?>

<head>
    <link rel="stylesheet" href='<?php echo Helper::asset("css/login.css") ?>'>
</head>
<div class="container">
    <div class="content">
        <div class="banner">
            <h1>HTU POS System</h1>
            <p>HTU established a store inside King Abdullah Business Park</p>
        </div>
        <form method="POST" action="/authenticate">
            <div class="form">
                <img src="<?php echo Helper::asset("images/users-images/image_user_8.png") ?>" alt="login-image" />
                <?php if (!empty($_SESSION) && isset($_SESSION['error']) && !empty($_SESSION['error'])) : ?>
                <div class="pos-Error-Massage" role='alert'>
                    <?= $_SESSION['error'] ?>
                </div>
                <?php
                    $_SESSION['error'] = null;
                endif; ?>
                <div>
                    <i class="fa-solid fa-user me-2 "></i>
                    <input type="text" name="username" required />
                </div>
                <div>
                    <i class="fa-solid fa-lock me-2"></i>
                    <input type="password" name="password" required />
                </div>
                <button type="submit">Sign In</button>
                <div>
                    <input class="pos-check" type="checkbox" id="remember-me" name="remember_me" />
                    <label class="pos-check" for="remember-me">keep me signed in</label>
                </div>
            </div>
        </form>
    </div>
</div>