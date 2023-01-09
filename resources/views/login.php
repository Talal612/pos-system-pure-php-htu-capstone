<div class="pos-login">

    <head>
        <link rel="stylesheet" href="<?= "http://" . $_SERVER['HTTP_HOST'] ?>/resources/css/login.css">
    </head>
    <div class="pos-Hero">


        <form method="POST" action="/authenticate">

            <div class="pos-Container">
                <div class="pos-box">
                    <h1>Login Account</h1>
                    <?php if (!empty($_SESSION) && isset($_SESSION['error']) && !empty($_SESSION['error'])) : ?>
                    <div class="pos-Error-Massage" role='alert'>
                        <?= $_SESSION['error'] ?>
                    </div>
                    <?php
                        $_SESSION['error'] = null;
                    endif; ?>

                    <div class="pos-register">
                        <i class="fa-solid fa-user"></i>
                        <input type="text" id="admin-username" name="username" placeholder="Username..." required>
                    </div>

                    <div class="pos-register">
                        <i class="fa-solid fa-lock"></i>
                        <input type="password" id="admin-password" name="password" placeholder="Password..." required>
                    </div>

                    <div class="pos-check">
                        <input type="checkbox" id="remember-me" name="remember_me">
                        <label class="form-check-label" for="remember-me">keep me signed in</label>
                    </div>
                    <button type="submit" id="pos-button">Login</button>
                </div>
            </div>
        </form>

    </div>
</div>
</div>