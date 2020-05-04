<?php
namespace App\Core;

use mysqli;
use App\Core\Config;

class DB
{
    public static $host;
    public static $user;
    public static $pass;
    public static $db;

    public static function setParams()
    {
        Config::loadConfFile('database');
        self::$host = Config::get('driver.mysql.host');
        self::$user = Config::get('driver.mysql.user');
        self::$pass = Config::get('driver.mysql.pass');
        self::$db = Config::get('driver.mysql.db');
    }

    public static function init()
    {
        self::setParams();
        return new mysqli(self::$host, self::$user, self::$pass, self::$db);
    }
}
