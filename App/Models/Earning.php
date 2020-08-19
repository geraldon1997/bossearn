<?php
namespace App\Models;

use App\Core\QueryBuilder;

class Earning extends QueryBuilder
{
    public static $table = 'earnings';

    public static function earningsTable()
    {
        $data = "id INT PRIMARY KEY AUTO_INCREMENT, ";
        $data .= "user_id INT NOT NULL, ";
        $data .= "bref INT NOT NULL, ";
        $data .= "bpoint INT NOT NULL, ";
        $data .= "data_uploaded TIMESTAMP";

        return self::create(self::$table, $data);
    }

    public static function bref()
    {
        $user_id = User::id();
        $result = self::find(self::$table, 'user_id', $user_id);
        return $result[0]['bref'];
    }

    public static function bpoint()
    {
        $user_id = User::id();
        $result = self::find(self::$table, 'user_id', $user_id);
        return $result[0]['bpoint'];
    }
}