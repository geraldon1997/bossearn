<?php
namespace App\Models;

use App\Models\Gateway;

class Vendor
{
    public static function createTable()
    {
        $sql = "CREATE TABLE IF NOT EXISTS `vendors` (
        `id` INT PRIMARY KEY AUTO_INCREMENT,
        `name` VARCHAR(40) NOT NULL,
        `phone` VARCHAR(15) NOT NULL,
        `bankname` VARCHAR(40) NOT NULL,
        `acctnum` VARCHAR(15) NOT NULL,
        `date_joined` TIMESTAMP NOT NULL
    )";
        Gateway::run($sql);
    }

    public static function register($values)
    {
        $val = implode("','", $values);
        $sql = "INSERT INTO `vendors` (`name`,`phone`,`bankname`,`acctnum`) VALUES ('$val') ";
        return Gateway::run($sql);
    }

    public static function all()
    {
        $sql = "SELECT * FROM `vendors` ORDER BY `name` ASC";
        return Gateway::fetch($sql);
    }
}
