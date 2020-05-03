<?php
namespace App\Models;

use App\Models\Gateway;

class Coupon
{
    public static function createCoupon()
    {
        $sql = "CREATE TABLE IF NOT EXISTS `coupons` (
        `id` INT PRIMARY KEY AUTO_INCREMENT,
        `coupon` VARCHAR(10) UNIQUE NOT NULL,
        `is_sold` BOOLEAN NOT NULL,
        `date_gen` TIMESTAMP NOT NULL
        )";
        Gateway::run($sql);
    }

    public static function createVendorCoupon()
    {
        $sql = "CREATE TABLE IF NOT EXISTS `vendor_coupons` (
        `id` INT PRIMARY KEY AUTO_INCREMENT,
        `vendor_id` INT NOT NULL,
        `coupon_id` INT NOT NULL,
        `is_sold` BOOLEAN NOT NULL,
        `date_bought` TIMESTAMP NOT NULL,
        FOREIGN KEY(`vendor_id`) REFERENCES vendors(`id`),
        FOREIGN KEY(`coupon_id`) REFERENCES coupons(`id`)
    )";
        Gateway::run($sql);
    }

    public static function createUserCoupon()
    {
        $sql = "CREATE TABLE IF NOT EXISTS `user_coupons` (
        `id` INT PRIMARY KEY AUTO_INCREMENT,
        `user_id` INT NOT NULL,
        `vc_id` INT NOT NULL,
        `date_bought` TIMESTAMP NOT NULL,
        `is_verified` BOOLEAN NOT NULL,
        FOREIGN KEY(`user_id`) REFERENCES users(`id`),
        FOREIGN KEY(`vc_id`) REFERENCES vendor_coupons(`id`)
    )";
        Gateway::run($sql);
    }

    public static function genCoupon($coupon)
    {
        $sql = "INSERT INTO `coupons` (`coupon`,`is_sold`) VALUES ('$coupon', false)";
        return Gateway::run($sql);
    }

    public static function sellCouponToVendor($vid, $cid)
    {
        $sql = "INSERT INTO `vendor_coupons` (`vendor_id`,`coupon_id`,`is_sold`) VALUES ('$vid','$cid',false)";
        $sold = "UPDATE `coupons` SET `is_sold` = true WHERE `id` = '$cid'";
        $sell = Gateway::run($sql);

        if ($sell) {
            return Gateway::run($sold);
        }
    }

    public static function sellCouponToUser($uid, $vcid)
    {
        $sql = "INSERT INTO `user_coupons` (user_id,vc_id,is_verified) VALUES ('$uid','$vcid',false) ";
        $sold = "UPDATE `vendor_coupons` SET `is_sold` = true WHERE `id` = '$vcid'";
        $sell = Gateway::run($sql);

        if ($sell) {
            return Gateway::run($sold);
        }
    }

    public static function findUserCoupon($uc)
    {
        $sql = "SELECT * FROM `coupons`, `vendor_coupons`, `user_coupons` WHERE `coupon` = '$uc', `user_coupons.vc_id` = `vendor_coupons.id`, `vendor_coupons.coupon_id` = `coupons.id`";
        return Gateway::fetch($sql);
    }

    public static function verifyCoupon($vcid)
    {
        $sql = "UPDATE `user_coupons` SET `is_verified` = true WHERE `vc_id` = '$vcid'";
        return Gateway::run($sql);
    }
}
