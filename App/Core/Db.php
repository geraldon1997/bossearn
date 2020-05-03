<?php
namespace App\Core;

use App\Core\Config;
use mysqli;

class Db
{
    public static $host;
    public static $user;
    public static $pass;
    public static $db;

    public static function setParams()
    {
        Config::load('database');
        self::$host = Config::get('driver.mysql.dbhost');
        self::$user = Config::get('driver.mysql.dbuser');
        self::$pass = Config::get('driver.mysql.dbpass');
        self::$db = Config::get('driver.mysql.dbname');
    }

    public static function connect()
    {
      return new mysqli(self::$host, self::$user, self::$pass, self::$db);
    }

    public static function init()
    {
      self::setParams()
      return self::connect();
    }
}