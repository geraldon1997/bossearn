<?php
namespace App\Models;

use App\Core\QueryBuilder;

class Bank extends QueryBuilder
{
    public static $table = 'banks';

    public static function banksTable()
    {
        $data = "id INT PRIMARY KEY AUTO_INCREMENT, ";
        $data .= "user_id INT UNIQUE, ";
        $data .= "bank VARCHAR(255), ";
        $data .= "account VARCHAR(20) ";

        return self::create(self::$table, $data);
    }

    public static function addBank($data)
    {
        $columns = self::columns(self::$table);
        return self::insert(self::$table, $columns, $data);
    }

    public static function isBankExist()
    {
        return self::exists(self::$table, 'user_id', USERID);
    }

    public static function info()
    {
        return self::find(self::$table, 'user_id', USERID)[0];
    }
}
