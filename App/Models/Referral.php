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
        $data .= "FOREIGN KEY (referrer) REFERENCES users(id) ON UPDATE CASCADE ON DELETE CASCADE, ";
        $data .= "FOREIGN KEY (referred) REFERENCES users(id) ON UPDATE CASCADE ON DELETE CASCADE";

        return self::create(self::$table, $data);
    }

    public static function id($ref)
    {
        $result = self::find(User::$table, 'ref', $ref);
        return $result[0]['id'];
    }

    public static function addReferral($values)
    {
        $columns = self::columns(self::$table);
        array_pop($columns);
        return self::insert(self::$table, $columns, $values);
    }

    public static function allRefs()
    {
        $referrer = User::authid();
        return self::find(self::$table, 'referrer', $referrer);
    }
}
