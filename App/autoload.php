<?php

use App\Models\Subscription;

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

define('HOME', '/');
define('HOW', '/page/how');
define('CONTACT', '/page/contact');



define('LOGIN', '/page/login');
define('REGISTER', '/page/register');

define('AUTH_LOGIN', '/auth/login');
define('AUTH_REGISTER', '/user/register');

define('CONTACT_SEND', '/contact/send');



if (isset($_SESSION['uname'])) {
    define('ONLINE_ACTIVATION', Subscription::subscriptionLink());
    define('PROFILE', '/user/profile');
    define('WITHDRAW', '/earning/withdraw');
    define('SPONSORED', '/post/sponsored-posts');
    define('LOGOUT', '/auth/logout');
    define('ACTIVATION_PAGE', '/user/activation');
}




