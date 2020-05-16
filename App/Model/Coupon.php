<?php
namespace App\Model;

use App\Model\User;
use App\Core\Gateway;

class Coupon extends Gateway
{
    public static function createCouponTable()
    {
        $sql = "CREATE TABLE IF NOT EXISTS `coupons` (
    	`id` INT PRIMARY KEY AUTO_INCREMENT,
        `coupon` VARCHAR(20) UNIQUE NOT NULL,
        `is_sold` BOOLEAN NOT NULL,
        `date_gen` TIMESTAMP
    )";
        self::run($sql);
    }

    public static function createVendorCouponTable()
    {
        $sql = "CREATE TABLE IF NOT EXISTS `vendors_coupons` (
    	`id` INT PRIMARY KEY AUTO_INCREMENT,
        `coupon_id` INT UNIQUE NOT NULL,
        `vendor_id` INT NOT NULL,
        `is_sold` BOOLEAN NOT NULL,
        `date_sold` TIMESTAMP
    )";
        self::run($sql);
    }

    public static function createUserCouponTable()
    {
        $sql = "CREATE TABLE IF NOT EXISTS `users_coupons` (
    	`id` INT PRIMARY KEY AUTO_INCREMENT,
        `user_id` INT NOT NULL,
        `vendors_coupons_id` INT UNIQUE NOT NULL,
        `is_verified` BOOLEAN NOT NULL,
        `date_verified` TIMESTAMP
    )";
        self::run($sql);
    }

    public static function generateCoupon($coupon)
    {
        $sql = "INSERT INTO `coupons` (`coupon`, `is_sold`) VALUES ('$coupon', false)";
        return self::run($sql);
    }

    public static function sellCouponToVendor($coupon, $vendor)
    {
        $cid = self::getCouponId('coupons', 'coupon', $coupon);
        $vid = User::getId($vendor);

        $sql = "INSERT INTO `vendors_coupons` (`coupon_id`,`vendor_id`,`is_sold`) VALUES ('$cid','$vid',false)";
        $vs = self::run($sql);

        if ($vs) {
            $sql1 = "UPDATE `coupons` SET `is_sold` = true WHERE `id` = '$cid'";
            return self::run($sql1);
        } else {
            return false;
        }
    }

    public static function sellCouponToUser($uname, $coupon)
    {
        $uid = User::getId($uname);
        $cid = self::getCouponId('coupons', 'coupon', $coupon);
        $vcid = self::getCouponId('vendors_coupons', 'coupon_id', $cid);
    }

    public static function verifyUserCoupon()
    {
        $sql = "";
        self::run($sql);
    }

    public static function getUnsoldCoupon($ctable, $num)
    {
        $sql = "SELECT * FROM $ctable WHERE `is_sold` = false LIMIT $num";
        return self::fetch($sql);
    }

    public static function getSoldCoupon($ctable)
    {
        $sql = "SELECT * From $ctable WHERE `is_sold` = true";
        return self::fetch($sql);
    }

    public static function getCouponId($table, $col, $val)
    {
        $sql = "SELECT * FROM $table WHERE $col = '$val' ";
        $id = self::fetch($sql);
        foreach ($id as $key) {
            return $key['id'];
        }
    }

    public static function getUserCoupon($id)
    {
        $sql = "SELECT * FROM users_coupons WHERE `user_id` = '$id'";
        $userCoupon = self::fetch($sql);
        foreach ($userCoupon as $key) {
            return $key;
        }
    }
}
