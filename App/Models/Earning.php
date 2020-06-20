<?php
namespace App\Models;

use App\Core\Gateway;

class Earning extends Gateway
{
    public static function createTable()
    {
        $sql = "CREATE TABLE IF NOT EXISTS earnings (
  	  `id` INT PRIMARY KEY AUTO_INCREMENT,
      `user_id` INT UNIQUE NOT NULL,
      `bref` INT NOT NULL,
      `bearn` INT NOT NULL,
      `withdraw` BOOLEAN NOT NULL
    )";
        Gateway::run($sql);
    }

    public static function insert($uid)
    {
        $sql = "INSERT INTO `earnings` (`user_id`,bref,bearn,withdraw) VALUES ('$uid',0,2500,false)";
        return Gateway::run($sql);
    }

    public static function updateBearn($bearn, $uid)
    {
        $oldBearn = self::findEarning($uid);
        $newBearn = $oldBearn[0]['bearn'] + $bearn;
        $sql = "UPDATE `earnings` SET bearn = '$newBearn' WHERE `user_id` = '$uid'";
        return Gateway::run($sql);
    }

    public static function updateBref($bref, $uid)
    {
        $oldBref = self::findEarning($uid);
        $newBref = $oldBref[0]['bref'] + $bref;
        $sql = "UPDATE `earnings` SET bref = '$newBref' WHERE `user_id` = '$uid'";
        return Gateway::run($sql);
    }

    public static function earnings($uid)
    {
        $sql = "SELECT SUM(bref + bearn) AS totalearnings FROM earnings WHERE `user_id` = '$uid'";
        return Gateway::fetch($sql);
    }

    public static function withdraw($type, $uid)
    {
        $sql = "UPDATE earnings SET `withdraw` = $type WHERE `user_id` = '$uid'";
        return Gateway::run($sql);
    }

    public static function status($uid)
    {
        $sql = "SELECT withdraw FROM earnings WHERE `user_id` = '$uid'";
        $result = Gateway::fetch($sql);
        return $result['withdraw'];
    }

    public static function findEarning($uid)
    {
        $sql = "SELECT * FROM earnings WHERE `user_id` = '$uid' ";
        return Gateway::fetch($sql);
    }

    public static function all()
    {
        $sql = "SELECT * FROM earnings";
        return Gateway::fetch($sql);
    }
}
