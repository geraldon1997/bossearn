<?php
namespace App\Controllers;

use App\Core\Config;

class Layout
{
    public static function start($path)
    {
        return Config::get($path);
    }

    public static function end($path)
    {
        return Config::get($path);
    }
}
