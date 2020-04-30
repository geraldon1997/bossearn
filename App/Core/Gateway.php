<?php
namespace App\Core;

use App\Core\Config;

class Gateway
{
    public static $host;
    public static $user;
    public static $pass;
    public static $db;

    public static function params()
    {
        echo self::$host = Config::get('database', 'driver.mysql.dbhost');
        echo self::$user = Config::get('database', 'driver.mysql.dbuser');
        echo self::$pass = Config::get('database', 'driver.mysql.dbpass');
        echo self::$db = Config::get('database', 'driver.mysql.dbname');
    }
}
