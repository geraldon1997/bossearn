<?php
require_once 'layout/header.php';

use App\Controllers\UserController;

?>
<style>
    .page-wrapper{
        margin-top: 100px;
        margin-bottom: 50px;
    }
</style>
<div class="page-wrapper text-center center">

    <div class="row">
        <div class="col-lg-3"></div>

        <div class="col-lg-6">
            <?php if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    UserController::login($_POST);
} ?>
        <h4>Login form</h4>
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