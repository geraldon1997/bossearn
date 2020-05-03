<?php
require_once 'autoload.php';

use App\Controllers\UserController;
use App\Models\Bank;
use App\Models\Coupon;
use App\Models\Referral;
use App\Models\Seeder;
use App\Models\User;
use App\Models\Vendor;

UserController::createUser(
    [
        'firstname' => 'mosco',
        'lastname' => 'gerald',
        'email' => 'mosco@me.com',
        'phone' => '09036924798',
        'username' => 'mosco',
        'password' => 'pass'
    ]
);
