<?php
namespace App\Controllers;

use App\Models\User;
use App\Models\Referral;
use App\Models\Earning;

class UserController extends User
{
    public static $success;

    public static function register($data)
    {
        $signup = User::insert($data);
        if ($signup) {
            self::$success['signup'] = 'Registeration was successful';
        }
    }

    public static function login($data)
    {
        $login = User::findUser('uname', $data['username']);
    }
}
