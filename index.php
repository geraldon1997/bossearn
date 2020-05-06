<?php

use App\Controller\UserController;
use App\Core\Config;
use App\Core\DB;
use App\Core\Gateway;
use App\Model\Referral;
use App\Model\User;

require_once "vendor/autoload.php";

$u = new UserController();
$r = $u->createUser(518412, [
    'fn' => 'mosco',
    'ln' => 'gerald',
    'email' => 'me@me.de',
    'phone' => '09234232',
    'un' => 'mosco',
    'pw' => 'cerjeirve'
]);

var_dump($r);
