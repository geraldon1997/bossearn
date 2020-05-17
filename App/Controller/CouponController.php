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

    public static function sellCoupon($coupon, $user)
    {
        $userRole = Role::getRole(User::getRoleId($_SESSION['uname']));
        
        if ($userRole == 'admin') {
            return self::sellCouponToVendor($coupon, $user);
        } elseif ($userRole == 'vendor') {
            return self::sellCouponToUser($user, $coupon);
        }
    }

    public static function verifyCoupon($coupon)
    {
        return self::verifyUserCoupon($coupon, $_SESSION['uname']);
    }

    public static function viewCoupons()
    {
        $userRole = Role::getRole(User::getRoleId($_SESSION['uname']));

        if (isset($_POST['sold_coupons'])) {
            if ($userRole == 'admin') {
                $sold = self::getSoldCoupon('coupons');
                if ($sold > 0) {
                    foreach ($sold as $key) {
                        echo "<tr>";
                        echo "<td>".$key['coupon']."</td>";
                        echo "</tr>";
                    }
                }
            } elseif ($userRole == 'vendor') {
                $sold = self::getSoldCoupon('vendors_coupons');
                if ($sold > 0) {
                    $sold1 = self::getCoupons('coupons', 'id', $sold[0]['coupon_id']);
                    foreach ($sold1 as $key) {
                        echo "<tr>";
                        echo "<td>".$key['coupon']."</td>";
                        echo "</tr>";
                    }
                } else {
                    echo 'no coupons have been sold';
                }
            }
        } elseif (isset($_POST['unsold_coupons'])) {
            if ($userRole == 'admin') {
                $unsold = self::getUnsoldCoupon('coupons');
                foreach ($unsold as $key) {
                    echo "<tr>";
                    echo "<td>".$key['coupon']."</td>";
                    echo "</tr>";
                }
            } elseif ($userRole == 'vendor') {
                $unsold = self::getUnsoldCoupon('vendors_coupons');

                if ($unsold > 0) {
                    $unsold1 = self::getCoupons('coupons', 'id', $unsold[0]['coupon_id']);
                    foreach ($unsold1 as $key) {
                        echo "<tr>";
                        echo "<td>".$key['coupon']."</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "no coupons left";
                }
            }
        }
    }
}
