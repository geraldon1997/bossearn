<?php
namespace App\Model;

use App\Core\Gateway;

class Referral
{
    public static function createTable()
    {
        $sql = "CREATE TABLE IF NOT EXISTS `referrals` (
            `id` INT PRIMARY KEY AUTO_INCREMENT,
            `ref_id` INT NOT NULL,
            `ref_user_id` INT NOT NULL
        )";
        return Gateway::run($sql);
    }
}
