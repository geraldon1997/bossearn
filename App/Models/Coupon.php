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
        $data .= "user_id INT NOT NULL, ";
        $data .= "date_generated DATE NOT NULL, ";
        $data .= "date_used TIMESTAMP NOT NULL, ";
        $data .= "FOREIGN KEY (subscription_id) REFERENCES subscriptions(id) ON UPDATE CASCADE ON DELETE CASCADE, ";
        $data .= "FOREIGN KEY (user_id) REFERENCES users(id) ON UPDATE CASCADE ON DELETE CASCADE";

        return self::create(self::$table, $data);
    }
}