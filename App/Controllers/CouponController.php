<?php
namespace App\Controllers;

use App\Models\Coupon;
use App\Models\User;

class CouponController extends Coupon
{
    public static $success;
    public static $error;

    public static function create($quantity)
    {
        $coupon = self::insert($quantity);
        if ($coupon) {
            self::$success['coupon'] = $quantity.' coupons generated';
        } else {
            self::$error['coupon'] = 'no coupon was generated, please try again';
        }
    }

    public static function view($col, $val)
    {
        $coupon = self::findCoupon($col, $val);
        foreach ($coupon as $key) {
            $cid = $key['id'];
            $cc = $key['coupon'];
            $cvb = $key['verified_by'];

            $user = User::findUser('id', $cvb);
        }
    }

    public static function verify($coupon)
    {
        $exist = self::couponExists($coupon);
        
        if ($exist) {
            $status = self::couponStatus($coupon);
            if (!$status) {
                self::updateCoupon(User::userId($_SESSION['uname'])[0]['id'], $coupon);
                echo "<script>window.location = 'profile.php'</script>";
            } else {
                self::$error = 'coupon already used';
            }
        } else {
            self::$error = 'invalid coupon';
            return;
        }
    }

    public static function userCouponStatus($un)
    {
        $user = User::findUser('uname', $un);
        return self::userStatus($user[0]['id']);
    }
}
