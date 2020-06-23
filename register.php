<?php
require_once 'layout/header.php';

use App\Controllers\UserController;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (isset($_GET['ref'])) {
        $data = UserController::validate($_GET['ref'], $_POST);
    } else {
        $data = UserController::validate(000000, $_POST);
    }
    
    $error = UserController::$error;
} 
?>
<style>
    
</style>
<div class="page-wrapper text-center center">

    <div class="row">
        <div class="col-lg-3"></div>

        <div class="col-lg-6">
            <form class="form-wrapper" method="POST">
            <?php if (isset($error['signup'])) {echo $error['signup'];} ?>
            <h4>Registration form</h4>
                <input type="text" class="form-control" placeholder="First name" name="firstname" value="<?php if (isset($_POST['firstname'])) {echo $_POST['firstname'];} ?>">
                
                <p><?php if (isset($error['firstname'])) {echo $error['firstname'];} ?></p>
                
                <input type="text" class="form-control" placeholder="Last name" name="lastname" value="<?php if (isset($_POST['lastname'])) {echo $_POST['lastname'];} ?>">
                
                <p><?php if (isset($error['lastname'])) {echo $error['lastname'];} ?></p>

                <input type="text" class="form-control" placeholder="Country" name="country" value="<?php if (isset($_POST['country'])) {echo $_POST['country'];} ?>">
                
                <p><?php if (isset($error['country'])) {echo $error['country'];} ?></p>
                
                <input type="email" class="form-control" placeholder="Email address" name="email" value="<?php if (isset($_POST['email'])) {echo $_POST['email'];} ?>">
                
                <p><?php if (isset($error['email'])) {echo $error['email'];} ?></p>

                <input type="tel" class="form-control" placeholder="Phone" name="phone" value="<?php if (isset($_POST['phone'])) {echo $_POST['phone'];} ?>">
                
                <p><?php if (isset($error['phone'])) {echo $error['phone'];} ?></p>

                <input type="text" class="form-control" placeholder="Username" name="username" value="<?php if (isset($_POST['username'])) {echo $_POST['username'];} ?>">
                
                <p><?php if (isset($error['username'])) {echo $error['username'];} ?></p>
                
                <input type="password" class="form-control" placeholder="Password" name="password" value="<?php if (isset($_POST['password'])) {echo $_POST['password'];} ?>">
                
                <p><?php if (isset($error['password'])) {echo $error['password'];} ?></p>
                
                <button type="submit" class="btn btn-primary">Register <i class="fa fa-arrow-right"></i></button>
            </form>
        </div>

        <div class="col-lg-3"></div>
    </div>
</div>

<?php require_once 'layout/footer.php'; ?>