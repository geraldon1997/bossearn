<?php
namespace App\Models;

use App\Core\Gateway;

class Referral extends Gateway
{
    public static function createTable()
    {
        $sql = "CREATE TABLE IF NOT EXISTS (
            `id` INT PRIMARY KEY AUTO_INCREMENT,
            `referrer` INT NOT NULL,
            `referred` INT NOT NULL
        )";
        Gateway::run($sql);
    }

    public static function insert($referrer, $referred)
    {
        $sql = "INSERT INTO `referral` (referrer,reffered) VALUES ('$referrer','$referred')";
        return Gateway::run($sql);
    }

    public static function findRef($col, $val)
    {
        $sql = "SELECT * FROM `referrals` WHERE $col = '$val'";
        return Gateway::fetch($sql);
    }
}
