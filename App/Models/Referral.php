<?php
namespace App\Models;

use App\Core\QueryBuilder;

class Referral extends QueryBuilder
{
    public static $table = 'referrals';

    public static function referralsTable()
    {
        $data = "id INT PRIMARY KEY AUTO_INCREMENT, ";
        $data .= "referrer INT NOT NULL, ";
        $data .= "referred INT NOT NULL, ";
        $data .= "date_updated TIMESTAMP, ";
        $data .= "FOREIGN KEY (referrer) REFERENCES users(id), ";
        $data .= "FOREIGN KEY (referred) REFERENCES users(id)";

        return self::create(self::$table, $data);
    }
}