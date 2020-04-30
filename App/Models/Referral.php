<?php
namespace App\Models;

use App\Core\Gateway;

class Referral extends Gateway
{
    public static function createTable()
    {
        $sql = "CREATE TABLE IF NOT EXISTS `referrals` (
            `id` INT PRIMARY KEY AUTO_INCREMENT,
            `ref_id` INT NOT NULL,
            `user_id` INT NOT NULL,
            FOREIGN KEY(`ref_id`) REFERENCES(`ref`) ON (`users`),
            FOREIGN KEY(`user_id`) REFERENCES(`id`) ON (`users`)
        ) ";
        return self::runQuery($sql);
    }

    public static function addRef($ref, $id)
    {
        $sql = "INSERT INTO `referrals` (`ref_id`,`user_id`) VALUES ('$ref', '$id') ";
        return self::runQuery($sql);
    }
}
