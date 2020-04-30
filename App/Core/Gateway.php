<?php
namespace App\Core;

use App\Core\Config;
use mysqli;

class Gateway
{
    public static function con()
    {
        Config::loadConfig('database');
        $host = Config::getFile('driver.mysql.host');
        $user = Config::getFile('driver.mysql.user');
        $pass = Config::getFile('driver.mysql.pass');
        $db = Config::getFile('driver.mysql.db');

        return new mysqli($host, $user, $pass, $db);
    }

    public static function runQuery($sql)
    {
        return self::con()->query($sql);
    }

    public static function fetchData($sql)
    {
        return self::con()->query($sql);
    }
}
