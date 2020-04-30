<?php
namespace App\Models;

use App\Core\Db;
use App\Models\Gateway;
use App\Models\Referral;

class User
{
    public static function createTable()
    {
        $sql = "CREATE TABLE IF NOT EXISTS `users` (
            `id` INT PRIMARY KEY AUTO_INCREMENT,
            `ref` INT UNIQUE NOT NULL,
            `firstname` VARCHAR(20) NOT NULL,
            `lastname` VARCHAR(20) NOT NULL,
            `email` VARCHAR(40) NOT NULL,
            `phone` VARCHAR(15) NOT NULL,
            `username` VARCHAR(20) NOT NULL,
            `password` VARCHAR(40) NOT NULL,
            `date_joined` TIMESTAMP NOT NULL
        ) ";
        return Gateway::run($sql);
    }

    public static function register($refid, $values)
    {
        $ref = rand(0, 999999);

        $val = implode("','", $values);
        $val = "'".$val."'";
        
        $sql = "INSERT INTO users (`ref`,`firstname`,`lastname`,`email`,`phone`,`username`,`password`) 
                VALUES ('$ref',$val)";

        Gateway::run($sql);
        $id = Db::init()->insert_id;
        Referral::addRef($refid, $id);
    }
}
