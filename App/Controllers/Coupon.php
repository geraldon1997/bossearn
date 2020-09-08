<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Models\Coupon as ModelsCoupon;
use App\Models\Subscription;
use App\Models\User;

class Coupon extends Controller
{
    public function createCoupon()
    {
        $number = $this->postData['quantity'];
        $subscriptionId = $this->postData['subscription'];

        $createCoupon = ModelsCoupon::insertCoupon($number, $subscriptionId);
        if ($createCoupon) {
            return $this->view('coupons', ["gen" => "$number coupons generated"]);
        }
    }

    public function verify()
    {
        $coupon = $this->postData['coupon'];
        
        if (ModelsCoupon::coupon_exists($coupon)) {
            $update = ModelsCoupon::updateCoupon($coupon, 1);
            if ($update) {
                $activate = User::activate(1);
                if ($activate) {
                    header('location:'.HOME);
                    return;
                }
            }
        }

        return $this->view('activation', ['error' => 'coupon does not exists']);
    }

    public function viewCoupon()
    {
        $is_used = $this->postData['coupon'];
        $result = ModelsCoupon::find(ModelsCoupon::$table, 'is_used', $is_used);
        
        return $this->view('coupons', $result);
    }
}
