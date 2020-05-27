<?php
namespace App\Models;

use App\Core\Gateway;

class Role extends Gateway
{
    public static function createTable()
    {
        $sql = "CREATE TABLE IF NOT EXISTS roles (
        	`id` INT PRIMARY KEY AUTO_INCREMENT,
            `role` VARCHAR(40) NOT NULL
        )";
        Gateway::run($sql);
    }

    public static function role()
    {
        $sql = "SELECT * FROM roles WHERE id = '$id'";
        return Gateway::fetch($sql);
    }
}
