<?php
namespace App\Models;

use App\Core\Gateway;
use App\Models\Earning;

class Comment extends Gateway
{
    public static function createTable()
    {
        $sql = "CREATE TABLE IF NOT EXISTS comments (
        	`id` INT PRIMARY KEY AUTO_INCREMENT,
            `user_id` INT NOT NULL,
            `post_id` INT NOT NULL,
            `comment` VARCHAR(255) NOT NULL,
            `date` TIMESTAMP
        )";
        Gateway::run($sql);
    }

    public static function insert($uid, $pid, $com)
    {
        $sql = "INSERT INTO comments (`user_id`,`post_id`,`comment`) VALUES ('$uid','$pid','$com')";
        // Earning::updateBearn(5, $uid);
        return Gateway::run($sql);
    }

    public static function findComment($col, $pid)
    {
        $sql = "SELECT * FROM comments WHERE $col = '$pid'";
        return Gateway::fetch($sql);
    }

    public static function checkComment($uid, $pid)
    {
        $sql = "SELECT * FROM comments WHERE `user_id` = '$uid' AND `post_id` = '$pid' ";
        return Gateway::check($sql);
    }
}
