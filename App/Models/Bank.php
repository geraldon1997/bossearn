<?php
namspace App\Models;

use App\Models\Gateway;

class Bank
{
  public static function createTable()
  {
    $sql = "CREATE TABLE IF NOT EXISTS `banks` (
        `id` INT PRIMARY KEY AUTO_INCREMENT,
        `user_id` INT NOT NULL,
        `bankname` VARCHAR(40) NOT NULL,
        `acct_num` INT NOT NULL,
        FOREIGN KEY(`user_id`) REFERENCES users(`id`)
    )";
    return Gateway::run($sql);
  }

  public static function add($id,$bank,$acct)
  {
    self::createTable();
    $sql = "INSERT INTO banks (user_id,bankname,acct_num) VALUES ('$id', '$bank', '$acct')";
    return Gateway::run($sql);
  }

  public static function all()
  {
    $sql = "SELECT * FROM `banks`, `users` WHERE `user_id` = `users.id`";
    return Gateway::fetch($sql);
  }

  public static function find($id)
  {
    $sql = "SELECT * FROM banks WHERE user_id = '$id'";
    return Gateway::fetch($sql);
  }
}