<?php
namespace App\Models;

use App\Core\Gateway;
use App\Models\Earning;

class Share extends Gateway
{
    public static function createTable()
    {
        $sql = "CREATE TABLE IF NOT EXISTS `shares` (
            `id` INT PRIMARY KEY AUTO_INCREMENT,
            `user_id` INT NOT NULL,
            `post_id` INT NOT NULL,
            `is_shared` BOOLEAN NOT NULL
        ) ";

        Gateway::run($sql);
    }

    public static function insert($uid, $pid)
    {
        $sql = "SELECT * FROM `shares` WHERE `user_id` = '$uid' AND `post_id` = '$pid' ";
        $checkShare = Gateway::check($sql);
        if ($checkShare < 1) {
            $sql = "INSERT INTO `shares` (`user_id`, `post_id`, `is_shared`) VALUES ('$uid', '$pid', 1) ";
            Earning::updateBearn(50, $uid);
            return Gateway::run($sql);
        }
        
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
