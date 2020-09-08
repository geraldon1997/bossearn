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

    public static function role()
    {
        $role_id = User::authinfo()['role_id'];
        $role = self::find(self::$table, 'id', $role_id);
        return $role[0]['role'];
    }
}
