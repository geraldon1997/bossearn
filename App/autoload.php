<?php

use App\Models\Subscription;
use App\Models\User;

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
define('VENDORS', '/page/vendors');


define('LOGIN', '/page/login');
define('REGISTER', '/page/register');

define('AUTH_LOGIN', '/auth/login');
define('AUTH_REGISTER', '/user/register');

define('CONTACT_SEND', '/contact/send');

define('ACTIVATION_PAGE', '/user/activation');

if (isset($_SERVER['HTTP_REFERER'])) {
    define('PREVIOUS_PAGE', $_SERVER['HTTP_REFERER']);
}


if (isset($_SESSION['uname'])) {
    define('ONLINE_ACTIVATION', Subscription::subscriptionLink());
    define('PROFILE', '/page/profile');
    define('WITHDRAWAL', '/page/withdrawals');
    define('SPONSORED', '/page/sponsored');
    define('LOGOUT', '/auth/logout');
    define('VERIFY_COUPON', '/coupon/verify');
    define('COUPONPAGE', '/page/coupons');
    define('GENERATE_COUPON', '/coupon/createCoupon');
    define('VIEW_COUPON', '/coupon/viewCoupon');
    define('ADDNEWSPAGE', '/page/addnews');
    define('ADDNEWS', '/news/create');
    define('READNEWSPAGE', '/news/read/');
    define('EDITNEWSPAGE', '/news/edit/');
    define('EDITNEWS', '/news/update/');
    define('USERID', User::authid());
    define('DELETE_POST', '/news/delete');
    define('REFERRALS', '/page/referrals');
    define('UPDATE_PROFILE', '/user/updateprofile');
    define('ADD_BANK', '/bank/add');
    define('UPDATE_DP', '/user/updatedp');
    define('EARNINGS', '/page/earnings');
    define('WITHDRAW', '/withdrawal/add');
    define('USERS', '/page/users');
    define('VIEW_USERS', '/user/viewUsers');
    define('BREF', '/page/bref');
    define('BPOINT', '/page/bpoint');
    define('EDIT_USER', '/user/edit');
    define('UPDATE_USER', '/user/update');
    define('MAKE_VENDOR', '/user/makevendor');
    define('MAKE_USER', '/user/makeuser');
    define('DELETE_USER', '/user/delete');
    define('PAY', '/withdrawal/pay');
    define('ACTIVATE_BPOINT', '/earning/activatebpoint');
    define('DEACTIVATE_BPOINT', '/earning/deactivatebpoint');
}
