<?php
require_once 'autoload.php';

use App\Controllers\UserController;

$_GET['ref'] = '345389';
UserController::createUser(['firstname' => 'mosco', 'lastname' => 'gerald', 'email' => 'me@me.com', 'phone' => '09036924798', 'username' => 'geraldon', 'password' => 'pass']);

$e = UserController::$errmsg;
$d = UserController::$data;
$s = UserController::$success;

var_dump($e)."<br>";
var_dump($d)."<br>";
var_dump($s)."<br>";
