<?php
namespace App\Core;

class Config
{
    public static $file;

    public static function load($data)
    {
        $dataFile = 'App/Configs/'.$data.'.php';
        
        if (file_exists($dataFile)) {
            self::$file = require_once $dataFile;
        }
    }

    public static function get($path)
    {
        $data = self::$file;

        if (strpos($path, '.')) {
            $pathArr = explode('.', $path);
            foreach ($pathArr as $key) {
                if (isset($data[$key])) {
                    $data = $data[$key];
                }
            }
        } else {
            $pathArr = [$path];
            foreach ($pathArr as $key) {
                if (isset($data[$key])) {
                    $data = $data[$key];
                }
            }
        }
        return $data;
    }
}
