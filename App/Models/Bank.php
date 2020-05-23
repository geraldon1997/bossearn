<?php
namespace App\Models;

use App\Core\Gateway;

class Bank extends Gateway
{
    public static function createTable()
    {
        $sql = "CREATE TABLE IF NOT EXISTS `users_banks` (
            `id` INT PRIMARY KEY AUTO_INCREMENT,
            `user_id` INT UNIQUE NOT NULL,
            `bank` VARCHAR(40) NOT NULL,
            `acct_name` VARCHAR(40) NOT NULL,
            `acct_num` VARCHAR(15) NOT NULL
        )";
        return Gateway::run($sql);
    }

    public static function insert($vals)
    {
        $val = implode("', '", $vals);
        $sql = "INSERT INTO banks (`user_id`,bank,acct_name,acct_num) VALUES ('$val')";
        return Gateway::run($sql);
    }

    public static function findBank($col, $val)
    {
        $sql = "SELECT * FROM users_banks WHERE $col = '$val'";
        return Gateway::fetch($sql);
    }
}
