<?php
namespace App\Models;

use App\Core\Gateway;
use App\Models\Earning;

class Share extends Gateway
{
    public static function createTable()
    {
        $sql = "CREATE TABLE IF EXISTS `shares` (
            id INT PRIMARY KEY AUTO_INCREMENT,
            `user_id` INT NOT NULL,
            `num_of_shares` INT NOT NULL
        ) ";

        Gateway::run($sql);
    }

    public static function insert($uid, $num)
    {
        $sql = "INSERT INTO `shares` (`user_id`, `num_of_shares`) VALUES ('$uid','$num') ";
        Earning::updateBearn(50, $uid);
        return Gateway::run($sql);
    }

    public static function updateShare($num, $uid)
    {
        $sql = "UPDATE `shares` SET `num_of_shares` = '$num' WHERE `user_id` = '$uid' ";
        Earning::updateBearn(50, $uid);
        return Gateway::run($sql);
    }

    public static function findShares($uid)
    {
        $sql = "SELECT * FROM `shares` WHERE `user_id` = '$uid' ";
        return Gateway::fetch($sql);
    }
}
