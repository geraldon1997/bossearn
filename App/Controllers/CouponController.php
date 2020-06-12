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

    public static function view()
    {
        $coupon = self::findCoupon($col, $val);
        foreach ($coupon as $key) {
            $cid = $key['id'];
            $cc = $key['coupon'];
            $cvb = $key['verified_by'];

            $user = User::findUser('id', $cvb);
        }
    }

    public static function verify()
    {
        $status = self::status($coupon);
        if ($status == false) {
            $user = User::findUser('uname', $_SESSION['uname']);
            $verify = self::updateCoupon($user[0]['id'], $coupon);

            if ($verify) {
                self::$success['coupon'] = 'coupon verified';
                header('refresh:1 url=index.php');
            } else {
                self::$error['coupon'] = 'coupon not verified';
            }
        } else {
            self::$error['coupon'] = 'coupon has been verified by another user';
        }
    }

    public static function hasUserVerifiedCoupon()
    {
        $user = User::findUser('uname', $_SESSION['uname']);
        $is = self::findCoupon('verified_by', $user[0]['id']);
        var_dump($is);
    }
}
