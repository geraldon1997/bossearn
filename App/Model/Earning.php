<?php
namespace App\Core;

use App\Core\Gateway;

class Earning extends Gateway
{
    public static function createTable()
    {
        $sql = "CREATE TABLE IF NOT EXISTS `earnings` (
            `id` INT PRIMARY KEY AUTO_INCREMENT,
            `user_id` INT UNIQUE NOT NULL,
            `bref` INT NOT NULL,
            `bearn` INT NOT NULL
        ) ";
        self::run($sql);
    }

    public static function addUser($uid)
    {
        $sql = "INSERT INTO `earnings` (`user_id`,`bearn`) VALUES ('$uid',2500)";
        self::run($sql);
    }

    public static function addEarning()
    {
        //
    }

    public static function viewEarning($uid)
    {
        $sql = "SELECT * FROM earnings WHERE `user_id` = '$uid'";
        return self::fetch($sql);
    }
}
