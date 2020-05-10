<?php
namespace App\Core;

use App\Core\Layout;
use App\Core\Config;

class View
{
    public $layout;

    public function __construct()
    {
        Config::loadConfFile('views');
    }

    public function login()
    {
        require_once Config::get('auth.login');
    }

    public function register()
    {
        require_once Config::get('auth.register');
    }

    public function dashboard()
    {
        Config::get('dashboard.index');
    }

    public function home()
    {
        require_once Config::get('home.index');
    }

    public function vendors()
    {
        require_once Config::get('home.vendors');
    }
}
