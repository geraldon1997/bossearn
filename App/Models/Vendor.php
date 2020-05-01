<?php
namespace App\Models;

use App\Models\Gateway;

class Vendor
{
  public static function createTable()
  {
    $sql = "CREATE TABLE IF NOT EXISTS `vendors` (
        `id` INT PRIMARY KEY AUTO_INCREMENT,
        `name` VARCHAR(40) NOT NULL,
        `phone` VARCHAR(15) NOT NULL,
        `bankname` VARCHAR(40) NOT NULL,
        `acctnum` VARCHAR(15) NOT NULL,
        `date_joined` DATE NOT NULL
    )";
    return Gateway::run($sql);
  }

  public static function register()
  {
    $sql = "";
    return Gateway::run($sql);
  }
}