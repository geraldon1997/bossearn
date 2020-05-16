<?php

use App\Controller\CouponController;

require_once 'vendor/autoload.php';

// $c = CouponController::createCoupon(10);
// echo CouponController::$success['coupongen'];
$c = CouponController::sellCoupon();
var_dump($c);
