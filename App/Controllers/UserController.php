<?php
namespace App\Controllers;

use App\Models\User;
use App\Models\Referral;
use App\Models\Earning;

class UserController extends User
{
    public static $success;
    public static $error;

    public static function register($ref, $data)
    {
        $refcode = rand(000000, 999999);
        $refExist = Referral::refExist($ref);
        if ($refExist) {
            $signup = User::insert($refcode, $data);
            if ($signup) {
                $referrer = Referral::refId($ref);
                $refferred = User::lastUserId()[0]['id'];
                
                Referral::insert($referrer, $refferred);
                
                Earning::insert($refferred);
                Earning::updateBref(10000, $referrer);
                self::$success['signup'] = 'Registeration was successful';
                echo "<script> window.location = 'index.php'; </script>";
                $_SESSION['uname'] = $data['username'];
            } else {
                self::$error['signup'] = 'username or email already exists';
            }
        } else {
            $signup = User::insert($refcode, $data);
            if ($signup) {
                $referrer = Referral::refId(Referral::assignRef());
                $refferred = User::lastUserId()[0]['id'];
                
                Referral::insert($referrer, $refferred);
                
                Earning::insert($refferred);
                Earning::updateBref(10000, $referrer);
                self::$success['signup'] = 'Registeration was successful';
            
                echo "<script> window.location = 'index.php'; </script>";
                $_SESSION['uname'] = $data['username'];
            } else {
                self::$error['signup'] = 'username or email already exists';
            }
        }
    }

    public static function login($data)
    {
        $login = User::findUser('uname', $data['username']);
        if ($login[0]['uname'] === $data['username'] && $login[0]['paswd'] === $data['password']) {
            echo "<script>window.location = '/';</script>";
            $_SESSION['uname'] = $data['username'];
        } else {
            self::$error['login'] = 'username or password is incorrect';
        }
    }
}
