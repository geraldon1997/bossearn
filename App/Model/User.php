<?php
namespace App\Model;

use App\Core\Gateway;

class User extends Gateway
{
    public function createTable()
    {
        $sql = "CREATE TABLE IF NOT EXISTS `users` (
            `id` INT PRIMARY KEY AUTO_INCREMENT,
            `ref` INT NOT NULL,
            `fname` VARCHAR(20) NOT NULL,
            `lname` VARCHAR(20) NOT NULL,
            `email` VARCHAR(40) UNIQUE NOT NULL,
            `phone` VARCHAR(15) NOT NULL,
            `uname` VARCHAR(20) UNIQUE NOT NULL,
            `password` VARCHAR(40) NOT NULL,
            `date_joined` TIMESTAMP
            )";
        return $this->run($sql);
    }

    public function register()
    {
        //
    }
}
