<?php
use App\Core\Layout;
use App\Controller\UserController;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    UserController::createUser($_GET['ref'], $_POST);
}

require_once Layout::start('auth.header');
?>
    
    <div class="limiter">
        <div class="container-login100">
            <div class="login100-more" style="background-image: url('<?php echo $assets; ?>images/bg-01.jpg');"></div>

            <div class="wrap-login100 p-l-50 p-r-50 p-t-72 p-b-50">
                <form class="login100-form validate-form" method="post">
                <span id="successmsg"><?php echo UserController::$success['register']; ?></span>
                <span id="successmsg"><?php echo UserController::$errmsg['register']; ?></span>
                    <span class="login100-form-title p-b-59">
                        Sign Up
                    </span>

                    <div class="wrap-input100 validate-input" data-validate="Name is required">
                        <span class="label-input100">First Name</span>
                        <input class="input100" type="text" name="fname" placeholder="First Name...">
                        <span class="focus-input100"></span>
                    </div>
                    <span id="errmsg"><?php echo UserController::$errmsg['fname']; ?></span>

                    <div class="wrap-input100 validate-input" data-validate="Last Name is required">
                        <span class="label-input100">Last Name</span>
                        <input class="input100" type="text" name="lname" placeholder="Last Name...">
                        <span class="focus-input100"></span>
                    </div>
                    <span id="errmsg"><?php echo UserController::$errmsg['lname']; ?></span>

                    <div class="wrap-input100 validate-input" data-validate = "Valid email is required: ex@abc.xyz">
                        <span class="label-input100">Email</span>
                        <input class="input100" type="email" name="email" placeholder="Email addess...">
                        <span class="focus-input100"></span>
                    </div>
                    <span id="errmsg"><?php echo UserController::$errmsg['email']; ?></span>

                    <div class="wrap-input100 validate-input" data-validate="mobile no is required">
                        <span class="label-input100">Mobile No</span>
                        <input class="input100" type="text" name="phone" placeholder="Mobile Number...">
                        <span class="focus-input100"></span>
                    </div>
                    <span id="errmsg"><?php echo UserController::$errmsg['phone']; ?></span><br><br>

                    <div class="wrap-input100 validate-input" data-validate="Username is required">
                        <span class="label-input100">Username</span>
                        <input class="input100" type="text" name="username" placeholder="Username...">
                        <span class="focus-input100"></span>
                    </div>
                    <span id="errmsg"><?php echo UserController::$errmsg['username']; ?></span><br><br>

                    <div class="wrap-input100 validate-input" data-validate = "Password is required">
                        <span class="label-input100">Password</span>
                        <input class="input100" type="password" name="pass" placeholder="*************">
                        <span class="focus-input100"></span>
                    </div>

                    <div class="flex-m w-full p-b-33">
                        <div class="contact100-form-checkbox">
                            <input class="input-checkbox100" id="ckb1" type="checkbox">
                            <label class="label-checkbox100" for="ckb1">
                                <span class="txt1">
                                    I agree to the
                                    <a href="#" class="txt2 hov1">
                                        Terms of Use
                                    </a>
                                </span>
                            </label>
                        </div>

                        
                    </div>

                    <div class="container-login100-form-btn">
                        <div class="wrap-login100-form-btn">
                            <div class="login100-form-bgbtn"></div>
                            <button class="login100-form-btn">
                                Sign Up
                            </button>
                        </div>

                        <a href="/login.php" class="dis-block txt3 hov1 p-r-30 p-t-10 p-b-10 p-l-30">
                            Sign in
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