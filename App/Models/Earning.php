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
      `withdraw` VARCHAR(10) NOT NULL,
      `status` BOOLEAN NOT NULL,
      `date` VARCHAR(50)
    )";
        Gateway::run($sql);
    }

    public static function insert($uid)
    {
        $date = time();
        $sql = "INSERT INTO `earnings` (`user_id`,bref,bearn,withdraw,`status`,`date`) VALUES ('$uid',0,2500,0,false,'$date')";
        return Gateway::run($sql);
    }

    public static function updateBearn($bearn, $uid)
    {
        $date = date('Y-m-d');
        $oldBearn = self::findEarning($uid);
        $newBearn = $oldBearn[0]['bearn'] + $bearn;
        $sql = "UPDATE `earnings` SET bearn = '$newBearn' WHERE `user_id` = '$uid'";
        $sql1 = "UPDATE `users` SET `date` = '$date' WHERE `id` = '$uid' ";
        $a = Gateway::run($sql);
        if ($a) {
            Gateway::run($sql1);
        }
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
        $sql = "UPDATE earnings SET `withdraw` = '$type', `status` = 1 WHERE `user_id` = '$uid'";
        return Gateway::run($sql);
        
    }

    public static function status($uid)
    {
        $sql = "SELECT `status` FROM earnings WHERE `user_id` = '$uid'";
        $result = Gateway::fetch($sql);
        return $result['status'];
    }

    public static function findEarning($uid)
    {
        $sql = "SELECT * FROM earnings WHERE `user_id` = '$uid' ";
        return Gateway::fetch($sql);
    }

    public static function all($type)
    {
        $sql = "SELECT * FROM earnings WHERE `withdraw` = '$type' AND `status` = 1";
        return Gateway::fetch($sql);
    }

    public static function paid($type, $uid)
    {
        $date = time();
        $sql = "UPDATE earnings SET $type = 0, `withdraw` = 0, `status` = 0, `date` = '$date' WHERE `user_id` = '$uid' ";
        return Gateway::run($sql);
    }
}
