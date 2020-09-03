<?php
namespace App\Core;

use mysqli;

class Database
{
    public static $mysqli;

    public static function init()
    {
        self::$mysqli = new mysqli('localhost','root','','bossearn_new');
        return self::$mysqli;
    }
}