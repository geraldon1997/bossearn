<?php

use App\Core\Config;
use App\Core\DB;
use App\Core\Gateway;
use App\Model\Referral;
use App\Model\User;

require_once "vendor/autoload.php";

$u = new User;
$r = new Referral;
$uu = $u->createTable();
$rr = $r->addRef([1,2]);

var_dump($rr);
