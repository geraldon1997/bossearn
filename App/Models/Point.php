<?php
namespace App\Models;

use App\Core\QueryBuilder;

class Point extends QueryBuilder
{
    public static $table = 'points';

    public static function pointsTable()
    {
        $data = "id INT PRIMARY KEY AUTO_INCREMENT, ";
        $data .= "subscription_id TINYINT NOT NULL, ";
        $data .= "signup_bonus INT NOT NULL, ";
        $data .= "comment INT NOT NULL, ";
        $data .= "shared_post INT NOT NULL, ";
        $data .= "daily_login INT NOT NULL, ";
        $data .= "news_click INT NOT NULL, ";
        $data .= "visitor_points INT NOT NULL, ";
        $data .= "referral_point INT NOT NULL, ";
        $data .= "FOREIGN KEY (subscription_id) REFERENCES subscriptions(id) ON UPDATE CASCADE ON DELETE CASCADE";

        return self::create(self::$table, $data);
    }

    public static function point($col, $val)
    {
        return self::find(self::$table, $col, $val);
    }
}
