<?php
namespace App\Controller;

use App\Model\Coupon;
use App\Controller\UserController;

class CouponController extends Coupon
{
    public static function isCouponVerified($un)
    {
        $userCoupon = Coupon::getUserCoupon(UserController::getId($un));
        if ($userCoupon['is_verified'] == true) {
            return true;
        } else {
            return false;
        }
    }
}
