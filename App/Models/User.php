<?php
namespace App\Models;

use App\Core\Gateway;

class User extends Gateway
{
    public static function createTable()
    {
        $sql = "CREATE TABLE IF NOT EXISTS `users` (
            `id` INT PRIMARY KEY AUTO_INCREMENT,
            `fname` VARCHAR(20) NOT NULL,
            `lname` VARCHAR(20) NOT NULL,
            `country` VARCHAR(40) NOT NULL,
            `email` VARCHAR(40) UNIQUE NOT NULL,
            `phone` VARCHAR(15) NOT NULL,
            `uname` VARCHAR(20) UNIQUE NOT NULL,
            `paswd` VARCHAR(40) NOT NULL,
            `role_id` INT NOT NULL,
            `date` DATE NOT NULL
        )";
        Gateway::run($sql);
    }

    public static function insert($vals)
    {
        $date = date('Y-m-d');
        $val = implode("', '", $vals);
        $sql = "INSERT INTO users (fname,lname,country,email,phone,uname,paswd,role_id,`date`) VALUES ('$val', 3, '$date')";
        return Gateway::run($sql);
    }

    public static function userId($un)
    {
        $sql = "SELECT id FROM users WHERE `uname` = '$un'";
        return Gateway::fetch($sql);
    }

    public static function lastUserId()
    {
        $sql = "SELECT id FROM users ORDER BY id DESC LIMIT 1";
        return Gateway::fetch($sql);
    }

    public static function findUser($col, $val)
    {
        $sql = "SELECT * FROM users WHERE $col = '$val'";
        return Gateway::fetch($sql);
    }

    public static function allUser()
    {
        $sql = "SELECT * FROM users ORDER BY fname ASC";
        return Gateway::fetch($sql);
    }

    public static function updateUser($fn, $ln, $ph, $un)
    {
        $sql = "UPDATE users SET fname = '$fn', lname = '$ln', phone = '$ph' WHERE uname = '$un' ";
        return Gateway::run($sql);
    }
}
