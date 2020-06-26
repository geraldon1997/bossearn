<?php
namespace App\Controllers;

use App\Models\Coupon;
use App\Models\Earning;
use App\Models\Referral;
use App\Models\User;

class CouponController extends Coupon
{
    public static $success;
    public static $error;

    public static function create($quantity)
    {
        $coupon = self::insert($quantity);
        if ($coupon) {
            return $quantity.' coupons generated';
        } else {
            return 'no coupon was generated, please try again';
        }
    }

    public static function view($col, $val)
    {
        $coupon = self::findCoupon($col, $val);
        $sn = 1;
        foreach ($coupon as $key) {
            $cid = $key['id'];
            $cc = $key['coupon'];
            $cvb = $key['user_id'];
            

            if ($cvb !== NULL) {
                $user = User::findUser('id', $cvb);
                $un = $user[0]['uname'];

                echo "<tr>
                        <td>".$sn++."</td>
                        <td>$cc</td>
                        <td>$un</td>
                </tr>";
            } else {
                echo "<tr>
                        <td>".$sn++."</td>
                        <td>$cc</td>
                        <td>NULL</td>
                </tr>";
            }
            
        }
    }

    public static function verify($coupon)
    {
        $exist = self::couponExists($coupon);
        
        if ($exist) {
            $status = self::couponStatus($coupon);
            if (!$status) {
                self::updateCoupon(User::userId($_SESSION['uname'])[0]['id'], $coupon);
                Earning::insert(User::userId($_SESSION['uname'])[0]['id']);
                Earning::updateBref(10000, Referral::findRef('referred', User::userId($_SESSION['uname'])[0]['referrer'] ));
                echo "<script>window.location = 'dashboard.php'</script>";
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
        $user = User::findLoginUser('uname', $un);
        return self::userStatus($user[0]['id']);
    }

    public static function searchCoupon($val)
    {
        $coupon = self::findCoupon('coupon', $val);
        $sn = 1;
        if (!empty($coupon)) {
            foreach ($coupon as $key) {
                $cid = $key['id'];
                $cc = $key['coupon'];
                $cvb = $key['user_id'];
                
    
                if ($cvb !== NULL) {
                    $user = User::findUser('id', $cvb);
                    $un = $user[0]['uname'];
    
                    echo "<tr>
                            <td>".$sn++."</td>
                            <td>$cc</td>
                            <td>$un</td>
                    </tr>";
                } else {
                    echo "<tr>
                            <td>".$sn++."</td>
                            <td>$cc</td>
                            <td>NULL</td>
                    </tr>";
                }
                
            }
        }
        
    }
}
