<?php
namespace App\Controller;

use App\Core\Config;
use App\Model\User;
use App\Model\Referral;
use App\Model\Role;

class UserController extends User
{
    private static $data = [];
    public static $errmsg = [];
    public static $success = [];

    public static function createUser($ref_id, array $values)
    {
        self::$data = $values;
        self::cleanInput();
        self::checkInput();
        self::validateEmail();
        self::validatePhone();
        self::checkIfRegDetailsExist();
        self::$data['pass'] = self::hashpwd(self::$data['pass']);
        
        if (empty(self::$errmsg)) {
            $checkRef = self::checkRefCode($ref_id);
            if ($checkRef > 0) {
                $register = self::register($ref_id, self::$data);
            } else {
                $ref = self::assignRef();
                $register = self::register($ref, self::$data);
            }
            // $email = self::$data['email'];
            // $expire = time() * 60 * 60 * 48;
            // Config::loadConfFile('templates');
            // $body = Config::get('email.verification');
            // self::sendEmail(self::$data['email'], 'Email Verification', $body);
        }
    }

    public static function checkIfRegDetailsExist()
    {
        $u = self::checkRegDetails('uname', self::$data['username']);
        $e = self::checkRegDetails('email', self::$data['email']);

        if ($u > 0) {
            self::$errmsg['username'] = self::$data['username']." has been taken, choose another username";
        }

        if ($e > 0) {
            self::$errmsg['email'] = self::$data['email']." has been taken, choose another email";
        }
    }

    public static function cleanInput()
    {
        foreach (self::$data as $key => $value) {
            $data = trim(htmlspecialchars(stripslashes(strip_tags(self::$data[$key]))));
            self::$data[$key] = $data;
        }
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
    }

    public static function validatePhone()
    {
        $phone = self::$data['phone'];
        $validPhone = filter_var($phone, FILTER_SANITIZE_NUMBER_INT);
        if ($validPhone) {
            self::$data['phone'] = $validPhone;
        } else {
            $msg = $phone." is not valid";
            self::$errmsg['phone'] = $msg;
            unset(self::$data['phone']);
        }
    }

    public static function hashpwd($pwd)
    {
        return md5($pwd);
    }

    public static function login($data)
    {
        self::$data = $data;
        self::cleanInput();
        self::checkInput();
        self::$data['pass'] = self::hashpwd(self::$data['pass']);
        $login = self::checkLogin(self::$data['username'], self::$data['pass']);
        var_dump($login);
        if ($login === "email not verified") {
            self::$errmsg['login'] = "please verify email first";
        } elseif ($login === "not exists") {
            self::$errmsg['login'] = "username or password is incorrect";
        } else {
            self::$success['login'] = "authentication was successful";
            header('refresh: 3 url=/');
            $_SESSION['uname'] = self::$data['username'];
        }
    }

    public static function logoutUser()
    {
        $logout = self::logout($_SESSION['uname']);
        if ($logout) {
            unset($_SESSION['uname']);
            header('location: /');
        }
    }

    public static function updateMyProfile($data)
    {
        self::$data = $data;
        self::cleanInput();
        self::checkInput();
        $uid = self::findUser('uname', $_SESSION['uname'])['id'];
        $update = self::updateProfile(self::$data['fname'], self::$data['lname'], self::$data['phone'], $uid);

        if ($update === true) {
            self::$success['update'] = 'profile updated successfully';
        } else {
            self::$errmsg['update'] = 'profile was not updated';
        }
    }

    public static function changePwd()
    {
        //
    }

    public static function forgotPwd($email)
    {
        Config::loadConfFile('templates');
        $body = Config::get('email.forgotpwd');
        self::sendEmail($email, 'Password Reset', $body);
    }

    public static function resetPwd($data)
    {
        self::$data = $data;
        self::cleanInput();
        self::checkInput();
        self::$data['pwd'] = self::hashpwd(self::$data['pwd']);
        self::updatePwd(self::$data['pwd'], 'email', self::$data['email']);
    }

    public static function sendEmail($email, $subject, $body)
    {
        $to = $email;
        $subject = 'subject';
        $message = $body;
        $headers .= "From: Support <support@bossearn.com>\n";
        $headers .= "X-Priority: 1\n";
        $headers .= "Content-Type:text/html; charset=\"iso-8859-1\"\n";
        mail($to, $subject, $message, $headers);
    }

    public static function getUserRole($uname)
    {
        return Role::getRole(User::getRoleId($uname));
    }
}
