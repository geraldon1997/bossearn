<?php

use App\Controller\UserController;
use App\Core\Config;
use App\Core\DB;
use App\Core\Gateway;
use App\Model\Referral;
use App\Model\User;

require_once "vendor/autoload.php";

$u = new UserController();
$r = $u->createUser(73019, [
    'fn' => 'mosco',
    'ln' => 'gerald',
    'email' => 'gen@test.com',
    'phone' => '09234232234',
    'un' => 'gen',
    'pw' => 'cerjeirve'
]);

var_dump($r);
