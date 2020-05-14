<?php
namespace App\Core;

use App\Core\Layout;
use App\Core\Config;

class View
{
    public $layout;

    public static function init()
    {
        Config::loadConfFile('views');
    }

    public static function login()
    {
        require_once Config::get('auth.login');
    }

    public static function register()
    {
        require_once Config::get('auth.register');
    }

    public static function coupon()
    {
        require_once Config::get('home.coupon');
    }

    public static function home()
    {
        require_once Config::get('home.index');
    }

    public static function vendors()
    {
        require_once Config::get('home.vendors');
    }

    public static function profile()
    {
        require_once Config::get('home.profile');
    }

    public static function earnings()
    {
        require_once Config::get('home.earnings');
    }

    public static function contact()
    {
        require_once Config::get('home.contact');
    }

    public static function how()
    {
        require_once Config::get('home.how');
    }
}
