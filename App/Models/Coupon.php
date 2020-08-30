<?php
namespace App\Models;

use App\Core\QueryBuilder;

class Coupon extends QueryBuilder
{
    public static $table = 'coupons';

    public static function couponsTable()
    {
        $data = "id INT PRIMARY KEY AUTO_INCREMENT, ";
        $data .= "subscription_id TINYINT NOT NULL, ";
        $data .= "coupon VARCHAR(16) NOT NULL, ";
        $data .= "is_used BOOLEAN NOT NULL, ";
        $data .= "user_id INT, ";
        $data .= "date_generated DATE NOT NULL, ";
        $data .= "date_used TIMESTAMP NOT NULL, ";
        $data .= "FOREIGN KEY (subscription_id) REFERENCES subscriptions(id) ON UPDATE CASCADE ON DELETE CASCADE, ";
        $data .= "FOREIGN KEY (user_id) REFERENCES users(id) ON UPDATE CASCADE ON DELETE CASCADE";

        return self::create(self::$table, $data);
    }

    public static function insertCoupon($number, $subscriptionId)
    {
        $columns = self::columns(self::$table);
        array_pop($columns);
        $date = date('Y-m-d');

        for ($i=0; $i < $number; $i++) {
            $coupon = self::generateCoupon();
            $addCoupon = self::insert(self::$table, $columns, [$subscriptionId, $coupon, 0, 1, $date]);
        }

        return $addCoupon;
    }

    public static function generateCoupon()
    {
        $letters = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890";
        $letters_length = strlen($letters);
        $random_string = '';

        for($i = 0; $i < 16; $i++) {
            $random_character = $letters[mt_rand(0, $letters_length - 1)];
            $random_string .= $random_character;
        }
 
        return $random_string;
    }

    public static function coupon_exists($coupon)
    {
        $exists = self::exists(self::$table, 'coupon', $coupon);
        $subscriptionId = User::authinfo()['subscription_id'];

        if ($exists) {
            $used = self::findMultiple(self::$table, ("coupon = '$coupon' AND is_used = FALSE AND subscription_id = '$subscriptionId' "));
            return $used;
        }

        return false;
    }

    public static function updateCoupon($coupon, $userId)
    {
        return self::update(self::$table, "user_id = $userId, is_used = TRUE", 'coupon', $coupon);
    }

    
}