<?php
namespace App\Controllers;

use App\Models\User;
use App\Models\Referral;
use App\Models\Earning;

class UserController extends User
{
    public static $success;

    public static function register($ref, $data)
    {
        $refcode = rand(000000, 999999);
        $refExist = Referral::refExist($ref);
        if ($refExist) {
            // $signup = User::insert($refcode, $data);
            // $referrer = Referral::refId($ref);
            // $refferred = User::lastUserId()[0]['id'];
            
            // Referral::insert($referrer, $refferred);
            
            // Earning::insert($refferred);
            // Earning::updateBref(10000, $referrer);

            // self::$success['signup'] = 'Registeration was successful';
        } else {
            $signup = User::insert($refcode, $data);
            $referrer = Referral::refId(Referral::assignRef());
            $refferred = User::lastUserId()[0]['id'];
            
            Referral::insert($referrer, $refferred);
            
            Earning::insert($refferred);
            Earning::updateBref(10000, $referrer);
        }
    }

    public static function login($data)
    {
        $login = User::findUser('uname', $data['username']);
    }
}
