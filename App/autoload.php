<?php
session_start();

spl_autoload_register('loadClass');

function loadClass($className)
{
    $class = str_ireplace('\\', '/', $className).'.php';
    if (!file_exists($class)) {
        return false;
    }
    require_once $class;
}

if (isset($_SESSION['uname'])) {
    define('HOME', '/home/index');
    define('HOW', '/home/how');
    define('CONTACT', '/home/contact');
    define('SPONSORED', '/post/sponsored-posts');
    define('PROFILE', '/user/profile');
    define('WITHDRAW', '/earning/withdraw');
    define('LOGOUT', '/user/logout');

}

define('HOME', '/');
define('HOW', '/page/how');
define('CONTACT', '/page/contact');
define('LOGIN', '/page/login');
define('REGISTER', '/page/register');