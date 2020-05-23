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
        $sql = "SELECT * FROM coupons WHERE $col = '$val'";
        return Gateway::fetch($sql);
    }

    public static function updateCoupon($val, $col, $value)
    {
        $sql = "UPDATE TABLE coupons SET `is_verified` = $val WHERE $col = $value";
        return Gateway::run($sql);
    }
}
