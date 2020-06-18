<?php
require_once 'layout/header.php';

use App\Controllers\UserController;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (!empty($_POST)) {
        UserController::register($_GET['ref'], $_POST);
    }
}
?>
<style>
    
</style>
<div class="page-wrapper text-center center">

    <div class="row">
        <div class="col-lg-3"></div>

        <div class="col-lg-6">
            <form class="form-wrapper" method="POST">
            <h4>Registration form</h4>
                <input type="text" class="form-control" placeholder="First name" name="fristname">
                <input type="text" class="form-control" placeholder="Last name" name="lastname">
                <input type="text" class="form-control" placeholder="Country" name="country">
                <input type="email" class="form-control" placeholder="Email address" name="email">
                <input type="tel" class="form-control" placeholder="Phone" name="phone">
                <input type="text" class="form-control" placeholder="Username" name="username">
                <input type="password" class="form-control" placeholder="Password" name="password">
                <button type="submit" class="btn btn-primary">Register <i class="fa fa-arrow-right"></i></button>
            </form>
        </div>

        <div class="col-lg-3"></div>
    </div>
</div>

<?php require_once 'layout/footer.php'; ?>