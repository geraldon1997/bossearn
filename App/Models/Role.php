<?php
namespace App\Models;

use App\Core\QueryBuilder;

class Role extends QueryBuilder
{
    public static $table = 'roles';

    public static function rolesTable()
    {
        $data = "id TINYINT PRIMARY KEY AUTO_INCREMENT, ";
        $data .= "role VARCHAR(20) NOT NULL";

        return self::create(self::$table, $data);
    }

    public static function isUser()
    {
        //
    }

    public static function isVendor()
    {
        //
    }

    public static function isAdmin()
    {
        //
    }
}