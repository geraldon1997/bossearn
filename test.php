<?php

use App\Controller\CouponController;
use App\Model\Coupon;

require_once 'vendor/autoload.php';

CouponController::viewCoupons();

?>

<form action="" method="post">
    <input type="submit" name="sold_coupons" value="view sold coupons">
</form>

<form action="" method="post">
    <input type="submit" name="unsold_coupons" value="view unsold coupons">
</form>