<?php
namespace App\Core;

class Config
{
    public static $confFile;
    public static $data;

    public static function loadConf($conf)
    {
        $newConf = 'App/Config/'.$conf.'.php';
        self::$confFile = require_once $newConf;
        return self::$confFile;
    }

    public static function getConf($conf)
    {
        $split = explode('.', $conf);
        self::$data = self::$confFile;

        foreach ($split as $value) {
            if (isset(self::$data[$value])) {
                self::$data = self::$data[$value];
            } else {
                self::$data = 'config not found';
            }
        }
        return self::$data;
    }
}
