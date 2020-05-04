<?php
namespace App\Core;

class Config
{
    public static $file;
    public static $data;

    public static function loadConfFile($confFile)
    {
        $conf = "App/Config/".$confFile.".php";
        if (file_exists($conf)) {
            self::$file = require_once $conf;
        }
    }

    public static function get($path)
    {
        self::$data = self::$file;

        if (strpos($path, '.')) {
            $pathArray = explode('.', $path);
            foreach ($pathArray as $key) {
                if (isset(self::$data[$key])) {
                    self::$data = self::$data[$key];
                }
            }
        } else {
            $pathArray = [$path];
            foreach ($pathArray as $key) {
                if (isset(self::$data[$key])) {
                    self::$data = self::$data[$key];
                }
            }
        }
        return self::$data;
    }
}
