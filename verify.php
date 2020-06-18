<?php

use App\Controllers\CouponController;

require_once 'layout/header.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    CouponController::verify($_POST['coupon']);    
}

?>

<style>

</style>

<div class="page-wrapper text-center">
    <div class="row">
        <div class="col-lg-3"></div>
        <div class="col-lg-6">
        <?php echo CouponController::$error; ?>
        <h4>Verify Coupon</h4>
            <form class="form-wrapper" method="POST" >
                <input type="text" name="coupon" class="form-control" placeholder="coupon">
                <button type="submit" class="btn">verify <i class="fa fa-arrow-right"></i></button>
            </form>
            <hr>
            <a href="vendors.php" class="btn" target="_blank">buy coupon</a>
        </div>
        <div class="col-lg-3"></div>
    </div>
</div>


<?php require_once 'layout/footer.php'; ?>