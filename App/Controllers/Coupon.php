<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Models\Coupon as ModelsCoupon;
use App\Models\User;

class Coupon extends Controller
{
    public function createCoupon(int $number, $subscriptionId)
    {
        return ModelsCoupon::insertCoupon($number, $subscriptionId);
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
}