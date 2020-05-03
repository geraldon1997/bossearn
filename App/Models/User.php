<?php
namespace App\Models;

use App\Core\Db;
use App\Models\Gateway;
use App\Models\Referral;
use App\Models\Coupon;

class User
{
    public static function createTable()
    {
        $sql = "CREATE TABLE IF NOT EXISTS `users` (
            `id` INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
            `ref` INT UNIQUE NOT NULL,
            `firstname` VARCHAR(20) NOT NULL,
            `lastname` VARCHAR(20) NOT NULL,
            `email` VARCHAR(40) UNIQUE NOT NULL,
            `phone` VARCHAR(15) NOT NULL,
            `username` VARCHAR(20) NOT NULL,
            `password` VARCHAR(40) NOT NULL,
            `is_email_verified` BOOLEAN NOT NULL,
            `date_joined` TIMESTAMP NOT NULL
        ) ";
        Gateway::run($sql);
    }

    public static function register($refid, $values)
    {
        $ref = rand(0, 999999);

        $val = implode("','", $values);
        $val = "'".$val."'";

        $sql = "INSERT INTO users 
                    (`ref`,`firstname`,`lastname`,`email`,`phone`,`username`,`password`,`is_email_verified`)
                VALUES 
                    ('$ref',$val,false)";
        
        $register = Gateway::run($sql);
        echo Db::init()->mysql_insert_id;
        
        // Referral::addRef($refid, $id);
    }

    public static function verifyemail($ref)
    {
        $sql = "UPDATE `users` SET `is_email_verified` = true WHERE `ref` = '$ref'";
        return Gateway::run($sql);
    }

    public static function all()
    {
        $sql = "SELECT * FROM users ORDER BY firstname ASC";
        return Gateway::fetch($sql);
    }

    public static function find($col, $val)
    {
        $sql = "SELECT * FROM users WHERE $col = '$val' ";
        return Gateway::run($sql);
    }

    public static function updatepwd($email, $pwd)
    {
        $sql = "UPDATE users SET `password` = '$pwd' WHERE `email` = '$email'";
        return Gateway::fetch($sql);
    }

    public static function updateprofile($fn, $ln, $ph, $id)
    {
        $sql = "UPDATE users SET
            `firstname` = '$fn',
            `lastname` = '$ln',
            `phone` = '$ph' WHERE `id` = '$id'";
        return Gateway::run($sql);
    }

    public static function updateUserDetails($col, $val, $id)
    {
        $sql = "UPDATE `users` SET $col = $val WHERE `id` = '$id'";
        return Gateway::run($sql);
    }

    public static function getLastId()
    {
        $sql = "SELECT LAST_INSERT_ID() ";
        Gateway::run($sql);
    }
}
