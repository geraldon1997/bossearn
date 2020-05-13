<?php
namespace App\Model;

use App\Core\Gateway;

class Bank extends Gateway
{
    public static function createTable()
    {
        $sql = "CREATE TABLE IF NOT EXISTS users_banks (
            `id` INT PRIMARY KEY AUTO_INCREMENT,
            `user_id` INT NOT NULL,
            `bankname` VARCHAR(40) NOT NULL,
            `acctnum` VARCHAR(20) NOT NULL,
            `date_added` TIMESTAMP
        )";
        self::run($sql);
    }

    public static function addAcct($val)
    {
        $sql = "INSERT INTO users_banks (`user_id`,`bankname`,`acctnum`) VALUES ('$val')";
        self::run($sql);
    }

    public static function getUserAcct($uid)
    {
        $sql = "SELECT * FROM users_banks, users WHERE `users_banks.user_id` = '$uid' ";
        return self::fetch($sql);
    }

    public static function getAllAccounts()
    {
        $sql = "SELECT * FROM `users_banks`, `users` WHERE `users_banks.user_id` = `users.id`";
        return self::fetch($sql);
    }

    public static function checkIfUserHasFilledBank($uid)
    {
        $sql = "SELECT * FROM users_banks WHERE `user_id` ='$uid' ";
        return self::checkExists($sql);
    }
}
