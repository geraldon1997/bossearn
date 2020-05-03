<?php
namespace App\Models;

use App\Models\Gateway;

class Referral extends Gateway
{
    public static function createTable()
    {
        $sql = "CREATE TABLE IF NOT EXISTS `referrals` (
            `id` INT PRIMARY KEY AUTO_INCREMENT,
            `ref_id` INT NOT NULL,
            `user_id` INT NOT NULL
        ) ";
        return self::run($sql);
    }

    public static function addRef(int $refid, int $id)
    {
        $sql = "INSERT INTO referrals (`ref_id`,`user_id`) VALUES ($refid, $id)";
        return self::run($sql);
        // return $sql;
    }

    public static function find($ref)
    {
        $sql = "SELECT * FROM `referrals`, `users` WHERE `ref_id` = '$ref'";
        return self::fetch($sql);
    }
}
