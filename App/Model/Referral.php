<?php
namespace App\Model;

use App\Core\Gateway;

class Referral extends Gateway
{
    public static function createTable()
    {
        $sql = "CREATE TABLE IF NOT EXISTS `referrals` (
            `id` INT PRIMARY KEY AUTO_INCREMENT,
            `ref_id` INT NOT NULL,
            `ref_user_id` INT NOT NULL
        )";
        self::run($sql);
    }

    public function addRef(array $refs)
    {
        $ref = implode(',', $refs);
        $sql = "INSERT INTO referrals (ref_id,ref_user_id) VALUES ($ref)";
        return $this->run($sql);
    }

    public function findRef($ref)
    {
        $sql = "SELECT * FROM users, referrals WHERE ref_user_id = $ref";
        $this->fetch($sql);
    }
}
