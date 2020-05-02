<?php
namespace App\Controllers;

use App\Models\User;

class UserController extends User
{

    public static $data = [];
    public static $errmsg = [];
    public static $success = [];

    public static function createUser(array $data)
    {
        // self::$data = $data;
        // self::cleanInput();
    }

    public static function cleanInput()
    {
        foreach (self::$data as $key => $value) {
            $data = trim(htmlspecialchars(stripslashes(strip_tags(self::$data[$key]))));
            self::$data[$key] = $data;
        }
        self::checkInput();
    }

    public static function checkInput()
    {
        foreach (self::$data as $key => $value) {
            if (self::$data[$key] = '' || self::$data[$key] === null || empty(self::$data[$key])) {
                $msg = "$key should not be empty";
                self::$errmsg[$key] = $msg;
                unset(self::$data[$key]);
            } else {
                self::$data[$key] = $value;
            }
        }
        self::validateEmail();
    }

    public static function validateEmail()
    {
        $mail = self::$data['email'];
        $email = filter_var($mail, FILTER_VALIDATE_EMAIL);
        if ($email) {
            self::$data['email'] = $email;
        } else {
            $msg = self::$data['email']." is not a valid email address";
            self::$errmsg['email'] = $msg;
            unset(self::$data['email']);
        }
        self::validatePhone();
    }

    public static function validatePhone()
    {
        $phone = self::$data['phone'];
        $validPhone = filter_var($phone, FILTER_SANITIZE_NUMBER_INT);
        if ($validPhone) {
            self::$data['phone'] = $validPhone;
            self::sendToRegister();
        } else {
            $msg = $phone." is not valid";
            self::$errmsg['phone'] = $msg;
            unset(self::$data['phone']);
        }
    }

    public static function sendToRegister()
    {
        // $ref_id = $_GET['ref'];
        // if (!empty($ref_id) && $ref_id !== null && $ref_id !== '') {
        //     $ref_id = trim(htmlspecialchars(stripslashes(strip_tags($_GET['ref']))));
        //     $checkref = self::find('ref', $ref_id);
            
        //     if ($checkref->num_rows > 0) {
        //         // self::register($ref_id, self::$data);
        //         // self::$success = 'registration was successful';
        //     } else {
        //         $msg = "invalid referral code";
        //         self::$errmsg['ref'] = $msg;
        //     }
        // }
    }
}
