<?php

use App\Controllers\UserController;
use App\Core\DBSeed;

require_once 'autoload.php';


$u = UserController::register(47211, [
    'fn' => 'mosco5',
    'ln' => 'mosco5',
    'cn' => 'naija',
    'em' => 'mosco5@me.com',
    'ph' => '123243453534',
    'un' => 'mosco5',
    'pw' => '12345'
]);

var_dump($u);
