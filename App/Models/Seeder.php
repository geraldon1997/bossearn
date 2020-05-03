<?php
namespace App\Models;

class Seeder
{
    public static function execute()
    {
        User::createTable();
        Referral::createTable();
        Vendor::createTable();
        Bank::createTable();
        Coupon::createCoupon();
        Coupon::createVendorCoupon();
        Coupon::createUserCoupon();
    }
}
