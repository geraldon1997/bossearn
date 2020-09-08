<?php
namespace App\Models;

use App\Core\QueryBuilder;

class Earning extends QueryBuilder
{
    public static $table = 'earnings';

    public static function earningsTable()
    {
        $data = "id INT PRIMARY KEY AUTO_INCREMENT, ";
        $data .= "user_id INT UNIQUE NOT NULL, ";
        $data .= "bref INT NOT NULL, ";
        $data .= "bpoint INT NOT NULL, ";
        $data .= "data_uploaded TIMESTAMP, ";
        $data .= "FOREIGN KEY (user_id) REFERENCES users(id) ON UPDATE CASCADE ON DELETE CASCADE";

        return self::create(self::$table, $data);
    }

    public static function addEarning(array $col, array $val)
    {
        return self::insert(self::$table, $col, $val);
    }

    public static function bref($user_id)
    {
        $result = self::find(self::$table, 'user_id', $user_id);
        return $result[0]['bref'];
    }

    public static function bpoint()
    {
        $user_id = User::authid();
        $result = self::find(self::$table, 'user_id', $user_id);
        return $result[0]['bpoint'];
    }

    public static function updateEarning($col, $val, $user_id)
    {
        return self::update(self::$table, "$col = $val", 'user_id', $user_id);
    }
}
