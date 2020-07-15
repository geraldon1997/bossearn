<?php

use App\Controllers\UserController;

require_once 'layout/header.php';


?>

<div class="page-wrapper text-center center">

    <div class="row">
        <div class="col-lg-3"></div>

        <div class="col-lg-6">

        <h4>Forgot Password form</h4>
        <?php if (isset($_POST['username'])) {
            UserController::forgotPassword($_POST['username']);
            echo "if your username exists on this platform and your email is valid, you will get a password reset link";
        } ?>
            <form class="form-wrapper" method="POST">
                <input type="text" name="username" class="form-control" placeholder="Username">
                <button type="submit" class="btn">Reset <i class="fa fa-arrow-right"></i></button>
            </form>
            <hr>
        
        </div>

        <div class="col-lg-3"></div>
    </div>
</div>

<?php require_once 'layout/footer.php'; ?>