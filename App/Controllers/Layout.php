<?php
namespace App\Controllers;

use App\Core\Config;

class Layout
{
    public static function start()
    {
        return 'layout/header.php';
    }

    public static function end($path)
    {
        return Config::get($path);
    }
}
