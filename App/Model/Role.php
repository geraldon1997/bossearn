<?php
namespace App\Model;

use App\Core\Gateway;

class Role extends Gateway
{
    public static function createTable()
    {
        $sql = "CREATE TABLE IF NOT EXISTS `roles` (
            `id` INT PRIMARY KEY AUTO_INCREMENT,
            `role` VARCHAR(20) NOT NULL
        )";
        self::run($sql);
    }

    public static function getAllRoles()
    {
        $sql = "SELECT * FROM `roles`";
        return self::fetch($sql);
    }

    public static function getRole($id)
    {
        $sql = "SELECT * FROM `roles` WHERE `id` = '$id' ";
        $role = self::fetch($sql);
        foreach ($role as $val) {
            return $val['role'];
        }
    }
}
