<?php
namespace App\Models;

use App\Core\QueryBuilder;

class User extends QueryBuilder
{
    public static $table = 'users';

    public static function usersTable()
    {
        $data = "id INT PRIMARY KEY AUTO_INCREMENT, ";
        $data .= "ref VARCHAR(10) NOT NULL, ";
        $data .= "surname VARCHAR(40) NOT NULL, ";
        $data .= "othernames VARCHAR(100) NOT NULL, ";
        $data .= "email VARCHAR(100) UNIQUE NOT NULL, ";
        $data .= "phone VARCHAR(15) NOT NULL, ";
        $data .= "username VARCHAR(20) UNIQUE NOT NULL, ";
        $data .= "password VARCHAR(40) NOT NULL, ";
        $data .= "date_joined DATE NOT NULL";

        return self::create(self::$table,$data);
    }

    public static function id()
    {
        $result = self::find(self::$table, 'username', $_SESSION['uname']);
        return $result[0]['id'];
    }

    public static function info()
    {
        $result = self::find(self::$table, 'username', $_SESSION['uname']);
        return $result[0];
    }
}