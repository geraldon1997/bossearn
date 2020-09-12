<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Controllers\Coupon;
use App\Models\Coupon as ModelsCoupon;
use App\Models\Payment as ModelsPayment;
use App\Models\User;

class Payment extends Controller
{
    public function success()
    {
        $reference = '76543243546576879';
        $userid = User::authid();
        $ptype = "online";
        $dpaid = date('Y-m-d');
        $subid = User::subscriptionId($userid);

        $coupon = ModelsCoupon::findMultiple(ModelsCoupon::$table, "subscription_id = '$subid' AND is_used = '0' LIMIT 1")[0]['coupon'];
        
        $columns = ModelsPayment::columns(ModelsPayment::$table);
        $values = [$userid,$ptype,$subid,$reference,$dpaid];

        ModelsPayment::insert(ModelsPayment::$table, $columns, $values);

        $c = new Coupon();
        $c->verify($coupon);
    }
}
