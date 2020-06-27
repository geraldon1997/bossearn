<?php
namespace App\Models;

use App\Core\Gateway;

class User extends Gateway
{
    public static function createTable()
    {
        $sql = "CREATE TABLE IF NOT EXISTS `users` (
            `id` INT PRIMARY KEY AUTO_INCREMENT,
            `ref` INT UNIQUE NOT NULL,
            `fname` VARCHAR(20) NOT NULL,
            `lname` VARCHAR(20) NOT NULL,
            `country` VARCHAR(40) NOT NULL,
            `email` VARCHAR(40) UNIQUE NOT NULL,
            `phone` VARCHAR(15) NOT NULL,
            `uname` VARCHAR(20) UNIQUE NOT NULL,
            `paswd` VARCHAR(40) NOT NULL,
            `role_id` INT NOT NULL,
            `date` DATE NOT NULL
        )";
        Gateway::run($sql);
    }

    public static function insert($ref, $vals)
    {
        $date = date('Y-m-d');
        $val = implode("', '", $vals);
        $sql = "INSERT INTO users (ref,fname,lname,country,email,phone,uname,paswd,role_id,`date`) VALUES ('$ref','$val', 3, '$date')";
        return Gateway::run($sql);
    }

    public static function userId($un)
    {
        $sql = "SELECT id FROM users WHERE `uname` = '$un'";
        return Gateway::fetch($sql);
    }

    public static function lastUserId()
    {
        $sql = "SELECT * FROM users ORDER BY id DESC LIMIT 1";
        $lastuserid = Gateway::fetch($sql);
        return $lastuserid;
    } 

    public static function findUser($col, $val)
    {
        $sql = "SELECT * FROM users WHERE $col = '$val' AND `uname` != 'maxfunny' ";
        return Gateway::fetch($sql);
    }

    public static function findLoginUser($col, $val)
    {
        $sql = "SELECT * FROM users WHERE $col = '$val' ";
        return Gateway::fetch($sql);
    }

    public static function findVerifiedUser($col, $val, $col1, $val1)
    {
        $sql = "SELECT * FROM `users` WHERE $col = '$val' AND $col1 = '$val1' AND `uname` != 'maxfunny' ";
        return Gateway::fetch($sql);
    }

    public static function searchVerifiedUser($col, $val, $col1, $val1)
    {
        $sql = "SELECT * FROM `users` WHERE $col = '$val' AND $col1 = '$val1' ";
        return Gateway::fetch($sql);
    }

    public static function allUser()
    {
        $sql = "SELECT * FROM users ORDER BY fname ASC";
        return Gateway::fetch($sql);
    }

    public static function updateUser($fn, $ln, $ph, $un)
    {
        $sql = "UPDATE users SET fname = '$fn', lname = '$ln', phone = '$ph' WHERE uname = '$un' ";
        return Gateway::run($sql);
    }

    public static function makeVendor($uid)
    {
        $sql = "UPDATE users SET role_id = 2 WHERE id = '$uid' ";
        return Gateway::run($sql);
    }

    public static function makeUser($uid)
    {
        $sql = "UPDATE users SET role_id = 3 WHERE id = '$uid' ";
        return Gateway::run($sql);
    }

    public static function deleteUser($uid)
    {
        $sql = "DELETE FROM users WHERE `id` = '$uid' ";
        $sql1 = "DELETE FROM users_banks WHERE `user_id` = '$uid' ";
        $sql2 = "DELETE FROM earnings WHERE `user_id` = '$uid' ";
        $sql3 = "DELETE FROM coupons WHERE `user_id` = '$uid' ";
        $sql4 = "DELETE FROM referrals WHERE `referrer` = '$uid' ";
        
        Gateway::run($sql);
        Gateway::run($sql1);
        Gateway::run($sql2);
        Gateway::run($sql3);
        Gateway::run($sql4);
    }

    public static function adminUpdateUser($uid, $email, $bn, $ban, $bacn)
    {
        $sql = "UPDATE users SET email = '$email' WHERE id = '$uid' ";
        Gateway::run($sql);
        $sql1 = "UPDATE users_banks SET bank = '$bn', acct_name = '$ban', acct_num = '$bacn' WHERE `user_id` = '$uid' ";
        Gateway::run($sql1);
        echo "<script>window.location = 'users.php' </script>";
    }

    public static function updatePass($un, $pass)
    {
        $sql = "UPDATE users SET paswd = '$pass' WHERE `uname` = '$un' ";
        $up = Gateway::run($sql);
        if ($up) {
            echo "<script>window.location = '/' </script>";
            $_SESSION['uname'] = $un;
        }
    }
}
