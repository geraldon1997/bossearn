<?php
namespace App\Core;

use App\Core\Config;

class Layout
{
    public static $assets = 'App/File/Auth/';
    
    public static function start($path)
    {
        Config::loadConfFile('layouts');
        return Config::get($path);
    }

    public static function end($path)
    {
        return Config::get($path);
    }
}
