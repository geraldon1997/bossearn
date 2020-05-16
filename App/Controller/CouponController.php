<?php
namespace App\Controller;

use App\Model\Coupon;
use App\Controller\UserController;
use App\Model\Role;
use App\Model\User;

class CouponController extends Coupon
{
    public static $success = [];
    public static function isCouponVerified($un)
    {
        $userCoupon = Coupon::getUserCoupon(UserController::getId($un));
        if ($userCoupon['is_verified'] == true) {
            return true;
        } else {
            return false;
        }
    }

    public static function createCoupon(int $num)
    {
        $chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        for ($i=0; $i < $num; $i++) {
            $gen = Coupon::generateCoupon(substr(str_shuffle($chars), 0, 16));
        }
        
        if ($gen == true) {
            self::$success['coupongen'] = $num.' coupons generated successfully';
        }
    }

    public static function sellCoupon()
    {
        $userRole = Role::getRole(User::getRoleId($_SESSION['uname']));
        
        if ($userRole == 'vendor') {
            return self::sellCouponToVendor('a8ioFRPGYUEHXMrJ', $_SESSION['uname']);
        } elseif ($userRole == 'user') {
            return self::sellCouponToUser($_SESSION['uname'], 'a8ioFRPGYUEHXMrJ');
        }
    }
}
