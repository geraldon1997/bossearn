<?php
namespace App\Model;

use App\Core\Gateway;
use App\Model\Referral;

class User extends Gateway
{
    public static function createTable()
    {
        $sql = "CREATE TABLE IF NOT EXISTS `users` (
            `id` INT PRIMARY KEY AUTO_INCREMENT,
            `ref` INT UNIQUE NOT NULL,
            `fname` VARCHAR(20) NOT NULL,
            `lname` VARCHAR(20) NOT NULL,
            `email` VARCHAR(40) UNIQUE NOT NULL,
            `phone` VARCHAR(15) NOT NULL,
            `uname` VARCHAR(20) UNIQUE NOT NULL,
            `passwd` VARCHAR(40) NOT NULL,
            `is_email_verified` BOOLEAN NOT NULL,
            `is_logged_in` BOOLEAN NOT NULL,
            `role_id` INT NOT NULL,
            `date_joined` TIMESTAMP NOT NULL
            )";
        self::run($sql);
    }

    public static function register(int $ref_id, array $values)
    {
        $ref = rand(0, 999999);
        $val = implode("', '", $values);
        $sql = "INSERT INTO users (ref,fname,lname,email,phone,uname,passwd,is_email_verified,is_logged_in,role_id) VALUES ($ref,'$val',false,false,3)";
        $register = self::run($sql);
        $refuserid = self::getLastId();
        $refid = self::findUser('ref', $ref_id)['id'];
        if ($register === true) {
            return Referral::addRef([$refid,$refuserid]);
        }
    }

    public static function getId($un)
    {
        $sql = "SELECT * FROM users WHERE `uname` = '$un' ";
        $id = self::fetch($sql);
        foreach ($id as $key) {
            return $key['id'];
        }
    }

    public static function getLastId()
    {
        $sql = "SELECT * FROM users ORDER BY id DESC LIMIT 1";
        $lastid = self::fetch($sql);
        foreach ($lastid as $key) {
            return $key['id'];
        }
    }

    public static function findUser($col, $val)
    {
        $sql = "SELECT * FROM users WHERE $col = '$val' ";
        $user = self::fetch($sql);
        foreach ($user as $key) {
            return $key;
        }
    }

    public static function getAllUsers($id)
    {
        $sql = "SELECT * FROM users WHERE `role_id` = $id ORDER BY fname ASC";
        $users = self::fetch($sql);
        foreach ($users as $key) {
            return $users;
        }
    }

    public static function checkRegDetails($col, $val)
    {
        $sql = "SELECT * FROM users WHERE $col = '$val' ";
        return self::checkExists($sql);
    }

    public static function checkRefCode($refcode)
    {
        $sql = "SELECT * FROM users WHERE ref = '$refcode' ";
        return self::checkExists($sql);
    }

    public static function getUserDetails(string $un)
    {
        $sql = "SELECT * FROM users WHERE uname = '$un' ";
        return self::fetch($sql);
    }

    public static function addUsersBank(Bank $bank, $data)
    {
        $values = implode("', '", $data);
        return $bank->addAcct($values);
    }

    public static function assignRef()
    {
        $sql = "SELECT ref FROM users ORDER BY RAND() LIMIT 1";
        $ref = self::fetch($sql);
        foreach ($ref as $key) {
            return $key['ref'];
        }
    }

    public static function checkLogin($un, $pwd)
    {
        $sql = "SELECT * FROM users WHERE uname = '$un' AND passwd = '$pwd' LIMIT 1";
        $login = self::checkExists($sql);
        if ($login > 0) {
            $details = self::fetch($sql);
            if ($details[0]['is_email_verified'] == true) {
                if ($details[0]['is_logged_in'] == false) {
                    $sql1 = "UPDATE `users` SET `is_logged_in` = 1 WHERE `uname` = '$un' ";
                    return self::run($sql1);
                } else {
                    return true;
                }
            } else {
                return 'email not verified';
            }
        } else {
            return 'not exists';
        }
    }

    public static function logout($un)
    {
        $sql = "SELECT * FROM `users` WHERE `uname` = '$un' AND `is_logged_in` = true LIMIT 1";
        $logout = self::checkExists($sql);
        if ($logout > 0) {
            $sql1 = "UPDATE `users` SET `is_logged_in` = false WHERE `uname` = '$un'";
            return self::run($sql1);
        } else {
            return true;
        }
    }

    public static function isLoggedIn($un)
    {
        $sql = "SELECT * FROM `users` WHERE `uname` = '$un' AND `is_logged_in` = true";
        return self::checkExists($sql);
    }

    public static function updateProfile($fn, $ln, $ph, $uid)
    {
        $sql = "UPDATE users SET `fname` = '$fn', `lname` = '$ln', `phone` = '$ph' WHERE `id` = '$uid' ";
        return self::run($sql);
    }

    public static function updatePwd($pwd, $col, $val)
    {
        $sql = "UPDATE users SET `password` = '$pwd' WHERE $col = '$val' ";
        return self::run($sql);
    }

    public static function getRoleId($un)
    {
        $sql = "SELECT * FROM `users` WHERE `uname` = '$un'";
        $roleid = self::fetch($sql);
        foreach ($roleid as $key) {
            return $key['role_id'];
        }
    }
}
