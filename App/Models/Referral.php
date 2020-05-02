<?php
namespace App\Models;

use App\Models\Gateway;

class Referral
{
    public static function createTable()
    {
        $sql = "CREATE TABLE IF NOT EXISTS `referrals` (
            `id` INT PRIMARY KEY AUTO_INCREMENT,
            `ref_id` INT NOT NULL,
            `user_id` INT NOT NULL,
            FOREIGN KEY('ref_id') REFERENCES users('ref'),
            FOREIGN KEY('user_id') REFERENCES users('id')
        ) ";
        Gateway::run($sql);
    }

    public static function addRef($refid, $id)
    {
        $sql = "INSERT INTO `referrals` (`ref_id`, `user_id`) VALUES ('$refid', '$id')";
        return Gateway::run($sql);
    }

    public static function find($ref)
    {
        $sql = "SELECT * FROM `referrals`, `users` WHERE `ref_id` = '$ref'";
        return Gateway::fetch($sql);
    }
}
