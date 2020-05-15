<?php
namespace App\Model;

use App\Core\Gateway;

class Coupon extends Gateway
{
    public static function createCouponTable()
    {
        $sql = "CREATE TABLE IF NOT EXISTS `coupons` (
    	`id` INT PRIMARY KEY AUTO_INCREMENT,
        `coupon` VARCHAR(10) UNIQUE NOT NULL,
        `is_sold` BOOLEAN NOT NULL,
        `date_gen` TIMESTAMP
    )";
        self::run($sql);
    }

    public static function createVendorCouponTable()
    {
        $sql = "CREATE TABLE IF NOT EXISTS `vendors_coupons` (
    	`id` INT PRIMARY KEY AUTO_INCREMENT,
        `coupon_id` INT NOT NULL,
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
        `vendors_coupons_id` INT NOT NULL,
        `is_verified` BOOLEAN NOT NULL,
        `date_verified` TIMESTAMP
    )";
        self::run($sql);
    }

    public static function generateCoupon($coupon)
    {
        $sql = "INSERT INTO `coupons` (`coupon`, `is_sold`) VALUES ($coupon, false)";
        self::run($sql);
    }

    public static function sellCouponToVendor($cid, $vid)
    {
        $sql = "INSERT INTO `vendors_coupons` (`coupon_id`,`vendor_id`,`is_sold`) VALUES ($cid, $vid, false)";
        self::run($sql);
        $sold = "UPDATE `coupons` SET `is_sold` = true WHERE `id` = '$cid' ";
        self::run($sold);
    }

    public static function sellCouponToUser($uid, $vcid)
    {
        $sql = "INSERT INTO `users_coupons` (`user_id`, `vendors_coupons_id`, `is_verified`) VALUES ('$uid', '$vcid', false)";
        self::run($sql);
        $sold = "UPDATE `vendors_coupons` SET `is_sold` = true WHERE `id` = '$vcid'";
        self::run($sold);
    }

    public static function verifyUserCoupon()
    {
        $sql = "";
        self::run($sql);
    }

    public static function getUnsoldCoupon($ctable)
    {
        $sql = "SELECT * FROM $ctable WHERE `is_sold` = false";
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
