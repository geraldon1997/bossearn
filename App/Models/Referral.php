<?php
namespace App\Models;

use App\Core\Gateway;

class Referral extends Gateway
{
    public static function createTable()
    {
        $sql = "CREATE TABLE IF NOT EXISTS `referrals` (
            `id` INT PRIMARY KEY AUTO_INCREMENT,
            `referrer` INT NOT NULL,
            `referred` INT UNIQUE NOT NULL
        )";
        Gateway::run($sql);
    }

    public static function insert($referrer, $referred)
    {
        $sql = "INSERT INTO `referrals` (referrer,referred) VALUES ('$referrer','$referred')";
        return Gateway::run($sql);
    }

    public static function findRef($col, $val)
    {
        $sql = "SELECT * FROM `referrals` WHERE $col = '$val'";
        return Gateway::fetch($sql);
    }
}
