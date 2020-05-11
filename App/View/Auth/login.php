<?php
use App\Core\Layout;
use App\Controller\UserController;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    UserController::login($_POST);
}
require_once Layout::start('auth.header');
?>
    
    <div class="limiter">
        <div class="container-login100">
            <div class="login100-more" style="background-image: url('<?php echo $assets; ?>images/bg-01.jpg');"></div>

            <div class="wrap-login100 p-l-50 p-r-50 p-t-72 p-b-50">
            <span id="errmsg"><?php echo UserController::$errmsg['login']; ?></span>
            <span id="successmsg"><?php echo UserController::$success['login']; ?></span>
                <form class="login100-form validate-form" method="post">
                    <span class="login100-form-title p-b-59">
                        Sign In
                    </span>

                    <div class="wrap-input100 validate-input" data-validate="Username is required">
                        <span class="label-input100">Username</span>
                        <input class="input100" type="text" name="username" placeholder="Username...">
                        <span class="focus-input100"></span>
                    </div>

                    <div class="wrap-input100 validate-input" data-validate = "Password is required">
                        <span class="label-input100">Password</span>
                        <input class="input100" type="password" name="pass" placeholder="*************">
                        <span class="focus-input100"></span>
                    </div>

                    <div class="container-login100-form-btn">
                        <div class="wrap-login100-form-btn">
                            <div class="login100-form-bgbtn"></div>
                            <button class="login100-form-btn">
                                Sign In
                            </button>
                        </div>

                        <a href="/register.php" class="dis-block txt3 hov1 p-r-30 p-t-10 p-b-10 p-l-30">
                            Sign Up
                            <i class="fa fa-long-arrow-right m-l-5"></i>
                        </a>
                    </div>
                </form>
                <hr>
                <div class="wrap-login100-form-btn">
                    <div class="login100-form-bgbtn"></div>
                    <a href="/" class="login100-form-btn">
                        home
                    </a>
                </div>
            </div>
        </div>
    </div>
    
<?php require_once Layout::end('auth.footer');