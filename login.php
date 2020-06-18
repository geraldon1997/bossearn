<?php
require_once 'layout/header.php';

use App\Controllers\UserController;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    UserController::login($_POST);
}

?>
<style>
    
</style>
<div class="page-wrapper text-center center">

    <div class="row">
        <div class="col-lg-3"></div>

        <div class="col-lg-6">

        <h4>Login form</h4>
          <?php if (isset(UserController::$error['login'])) { echo UserController::$error['login']; } ?>
            <form class="form-wrapper" method="POST" action="">
                <input type="text" name="username" class="form-control" placeholder="Username">
                <input type="password" name="password" class="form-control" placeholder="Password">
                <button type="submit" class="btn">Login <i class="fa fa-arrow-right"></i></button>
            </form>
        </div>

        <div class="col-lg-3"></div>
    </div>
</div>

<?php require_once 'layout/footer.php'; ?>