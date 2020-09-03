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

define('ACTIVATION_PAGE', '/user/activation');

if (isset($_SESSION['uname'])) {
    define('ONLINE_ACTIVATION', Subscription::subscriptionLink());
    define('PROFILE', '/page/profile');
    define('WITHDRAW', '/page/withdraw');
    define('SPONSORED', '/page/sponsored-posts');
    define('LOGOUT', '/auth/logout');
    define('VERIFY_COUPON', '/coupon/verify');
    define('COUPONPAGE', '/page/coupons');
    define('GENERATE_COUPON', '/coupon/createCoupon');
    define('VIEW_COUPON', '/coupon/viewCoupon');
    define('ADDNEWSPAGE', '/page/addnews');
    define('ADDNEWS', '/news/create');
}




