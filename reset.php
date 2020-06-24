<?php

use App\Controllers\UserController;
use App\Models\User;

require_once 'layout/header.php';

if (!isset($_GET['u']) || empty($_GET['u'])) {
    echo "<script>window.location = '/' </script>";
}

if (isset($_POST['password'])) {
    User::updatePass($_GET['u'], $_POST['password']);
}

?>

<div class="page-wrapper text-center center">

    <div class="row">
        <div class="col-lg-3"></div>

        <div class="col-lg-6">

        <h4>Forgot Password form</h4>
        
            <form class="form-wrapper" method="POST">
                <input type="text" name="password" class="form-control" placeholder="new password">
                <button type="submit" class="btn">Reset <i class="fa fa-arrow-right"></i></button>
            </form>
            <hr>
        
        </div>

        <div class="col-lg-3"></div>
    </div>
</div>

<?php require_once 'layout/footer.php'; ?>