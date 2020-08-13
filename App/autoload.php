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

define('APP_ROOT', dirname(__DIR__));
define('ASSETS', '/App/Assets');

define('HOME', '/', true);
define('HOW', '/page/how', true);
define('CONTACT', '/page/contact', true);
define('SPONSORED', '/post/sponsored-posts', true);
define('PROFILE', '/user/profile', true);
define('WITHDRAW', '/earning/withdraw', true);
define('LOGOUT', '/auth/logout', true);

define('LOGIN', '/page/login', true);
define('REGISTER', '/page/register', true);

define('AUTH_LOGIN', '/auth/login');
define('AUTH_REGISTER', '/auth/register');

define('CONTACT_SEND', '/contact/send');
