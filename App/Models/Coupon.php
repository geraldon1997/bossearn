<?php
namespace App\Models;

use App\Core\Gateway;

class Coupon extends Gateway
{
    public static function createTable()
    {
        $sql = "CREATE TABLE IF NOT EXISTS coupons (
            `id` INT PRIMARY KEY AUTO_INCREMENT,
            `coupon` VARCHAR(20) UNIQUE NOT NULL,
            `is_verified` BOOLEAN NOT NULL,
            `user_id` INT NULL,
            `date` TIMESTAMP
        )";
        Gateway::run($sql);
    }

    public static function genCoupon()
    {
        $chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $input_length = strlen($chars);
        $random_string = '';
        for ($i = 0; $i < 16; $i++) {
            $random_character = $chars[mt_rand(0, $input_length - 1)];
            $random_string .= $random_character;
        }

        return $random_string;
    }

    public static function insert($quantity)
    {
        for ($i=0; $i < $quantity; $i++) {
            $coupon = self::genCoupon();
            $sql = "INSERT INTO coupons (coupon,is_verified) VALUES ('$coupon',false)";
            $result = Gateway::run($sql);
        }
        return $result;
    }

    public static function findCoupon($col, $val)
    {
        if ($val == 0) {
            $sql = "SELECT * FROM coupons WHERE $col = '$val' ";
        } elseif ($val == 1) {
            $sql = "SELECT * FROM coupons WHERE $col = '$val' AND `user_id` != 5 ";
        } else {
            $sql = "SELECT * FROM coupons WHERE $col = '$val' ";
        }
        
        return Gateway::fetch($sql);
    }

    public static function updateCoupon($uid, $coupon)
    {
        $sql = "UPDATE coupons SET `is_verified` = true, `user_id` = '$uid' WHERE coupon = '$coupon'";
        return Gateway::run($sql);
    }

    public static function couponExists($coupon)
    {
        $sql = "SELECT * FROM coupons WHERE coupon = '$coupon'";
        return Gateway::check($sql);
    }

    public static function couponStatus($coupon)
    {
        $sql = "SELECT * FROM coupons WHERE coupon = '$coupon' ";
        $result = Gateway::fetch($sql);
        return $result[0]['is_verified'];
    }

    public static function userStatus($uid)
    {
        $sql = "SELECT * FROM coupons WHERE `user_id` = '$uid' ";
        return Gateway::check($sql);
    }
}
