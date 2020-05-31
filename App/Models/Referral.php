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

  public static function assignRef()
  {
    $sql = "SELECT ref FROM users ORDER BY RAND LIMIT 1";
    $ref = Gateway::fetch($sql);
    return $ref[0]['ref'];
  }

  public static function refId($ref)
  {
    $sql = "SELECT id FROM users WHERE ref = '$ref'";
    $ref = Gateway::fetch($sql);
    return $ref[0]['id'];
  }

  public static function refExist($ref)
  {
    //
  }
}