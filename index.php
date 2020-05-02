<?php
require_once 'autoload.php';

use App\Controllers\UserController;

$_GET['ref'] = '345389';
$u = UserController::createUser(
    [
        'firstname' => 'mosco',
        'lastname' => 'gerald',
        'email' => 'me@me.me',
        'phone' => '09036924798',
        'username' => 'geraldon',
        'password' => 'pass'
    ]
);

$e = UserController::$errmsg;
$d = UserController::$data;
$s = UserController::$success;

var_dump($e, $d, $s);
