<?php
namespace App\Model;

use App\Model\Bank;
use App\Model\Referral;
use App\Model\Role;
use App\Model\User;
use App\Model\Coupon;

class Seeder
{
    public static function seed()
    {
        User::createTable();
        Referral::createTable();
        Bank::createTable();
        Role::createTable();
        Coupon::createCouponTable();
        Coupon::createVendorCouponTable();
        Coupon::createUserCouponTable();
        return "tables created successfully";
    }
}
