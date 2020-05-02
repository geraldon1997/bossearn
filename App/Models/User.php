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
            `id` INT PRIMARY KEY AUTO_INCREMENT,
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
        return Gateway::run($sql);
    }

    public static function register($refid, $values)
    {
        $ref = rand(0, 999999);

        $val = implode("','", $values);
        $val = "'".$val."'";

        $sql = "INSERT INTO users (`ref`,`firstname`,`lastname`,`email`,`phone`,`username`,`password`)
                VALUES ('$ref',$val)";

        Gateway::run($sql);
        $id = Db::init()->insert_id;
        Referral::addRef($refid, $id);
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

    public static function find($id)
    {
        $sql = "SELECT * FROM users WHERE `id` = '$id'";
        return Gateway::fetch($sql);
    }

    public static function updatepwd($email, $pwd)
    {
        $sql = "UPDATE users SET `password` = '$pwd' WHERE `email` = '$email'";
        return Gateway::fetch($sql);
    }

    public static function updateprofile($values)
    {
        $sql = "UPDATE users SET
      `firstname` = '$fn',
      `lastname` = '$ln',
      `phone` = '$ph' WHERE `id` = '$id'";
        return Gateway::run($sql);
    }
}