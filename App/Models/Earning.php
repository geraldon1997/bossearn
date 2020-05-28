<?php
namespace App\Models;

use App\Core\Gateway;

class Earning extends Gateway
{
    public static function createTable()
    {
        $sql = "CREATE TABLE IF NOT EXISTS earnings (
  	  `id` INT PRIMARY KEY AUTO_INCREMENT,
      `user_id` INT NOT NULL,
      `bref` INT NOT NULL,
      `bearn` INT NOT NULL,
      `withdraw` BOOLEAN NOT NULL
    )";
        Gateway::run($sql);
    }

    public static function insert($uid, $bref, $bearn)
    {
        $sql = "INSERT INTO `earnings` (`user_id`,bref,bearn,withdraw) VALUES ('$uid',0,2500,false)";
        return Gateway::run($sql);
    }

    public static function updateBearn($bearn, $uid)
    {
        $sql = "UPDATE `earnings` SET bearn = '$bearn' WHERE `user_id` = '$uid'";
        return Gateway::run($sql);
    }

    public static function updateBref()
    {
        $sql = "UPDATE `earnings` SET bref = '$bref' WHERE `user_id` = '$uid'";
        return Gateway::run($sql);
    }

    public static function earnings($uid)
    {
        $sql = "SELECT SUM(bref + bearn) FROM earnings WHERE `user_id` = '$uid'";
        return Gateway::fetch($sql);
    }

    public static function withdraw($uid)
    {
        $sql = "UPDATE earnings SET `withdraw` = true WHERE `user_id` = '$uid'";
        return Gateway::run($sql);
    }

    public static function status($uid)
    {
        $sql = "SELECT withdraw FROM earnings WHERE `user_id` = '$uid'";
        $result = Gateway::check($sql);
        if ($result > 0) {
            return true;
        } else {
            return false;
        }
    }
}