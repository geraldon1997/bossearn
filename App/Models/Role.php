<?php
namespace App\Models;

use App\Core\Gateway;

class Role extends Gateway
{
    public static function createTable()
    {
        $sql = "CREATE TABLE IF NOT EXISTS roles (
        	`id` INT PRIMARY KEY AUTO_INCREMENT,
            `role` VARCHAR(40) UNIQUE NOT NULL
        )";
        Gateway::run($sql);
    }

    public static function insert($r)
    {
        $sql = "INSERT INTO roles (`role`) VALUES ('$r')";
        return Gateway::run($sql);
    }

    public static function role($id)
    {
        $sql = "SELECT * FROM roles WHERE id = '$id'";
        return Gateway::fetch($sql);
    }
}
