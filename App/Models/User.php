<?php
namespace App\Models;

use App\Core\Gateway;

class User extends Gateway
{
    public static function createTable()
    {
        $sql = "CREATE TABLE IF NOT EXISTS (
            `id` INT PRIMARY KEY AUTO_INCREMENT,
            `ref` INT UNIQUE NOT NULL,
            `firstname` VARCHAR(20) NOT NULL,
            `lastname` VARCHAR(20) NOT NULL,
            `email` VARCHAR(40) NOT NULL,
            `phone` VARCHAR(15) NOT NULL,
            `username` VARCHAR(20) NOT NULL,
            `password` VARCHAR(40) NOT NULL,
            `date_joined` DATE
            ) ";
        self::runQuery($sql);
    }
    public static function register($values)
    {
        $val = implode("','", $values);
        $val .= "'".$val."'";

        $sql = "INSERT INTO `users` (ref,firstname,lastname,email,phone,username,password) VALUES ($val) ";
        return self::runQuery($sql);
    }
}
