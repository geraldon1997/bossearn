<?php
namespace App\Core;

use App\Core\Config;

class View
{

    public static $view;
    public static $viewRoot;
    public static $layoutRoot;

    public function __construct()
    {
        Config::loadConf('views');
        self::$viewRoot = Config::getConf('root.view');
        self::$layoutRoot = Config::getConf('root.layout');
    }

    public static function make($view)
    {
        self::$view = $view;

        self::start();
        
        $viewFile = self::$viewRoot.$view.'.php';
        
        if (file_exists($viewFile)) {
            require_once $viewFile;
        } else {
            require_once self::$viewRoot.'error.php';
        }

        self::end();
    }

    public static function start()
    {
        require_once self::$layoutRoot.'home/headmeta.php';
    }

    public static function end()
    {
        require_once self::$layoutRoot.'home/footmeta.php';
    }
}
