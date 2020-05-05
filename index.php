<?php

use App\Core\Config;
use App\Core\DB;
use App\Core\Gateway;
use App\Model\Referral;
use App\Model\User;

require_once "vendor/autoload.php";

$u = new User(new Referral);
// $r = $u->register(123456, [
//     'fn' => 'mosco',
//     'ln' => 'gerald',
//     'email' => 'me@me.com',
//     'ph' => '09234232',
//     'un' => 'hades',
//     'pw' => 'cerjeirve'
// ]);

// var_dump($r);
