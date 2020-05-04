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
            `ref_user_id` INT NOT NULL,
            FOREIGN KEY(ref_id) REFERENCES users(ref) ON UPDATE CASCADE ON DELETE CASCADE,
            FOREIGN KEY(ref_user_id) REFERENCES users(id) ON UPDATE CASCADE ON DELETE CASCADE
        )";
        return Gateway::run($sql);
    }

  public static function addRef(array $refs)
  {
    $ref = implode(',', $refs);
    $sql = "INSERT INTO referrals (ref_id,ref_user_id) VALUES ($ref)";
    return Gateway::run($sql);
  }

  public static function findRef($ref)
  {
    $sql = "SELECT * FROM users, referrals WHERE ref_user_id = $ref";
    return Gateway::fetch($sql);
  }
}