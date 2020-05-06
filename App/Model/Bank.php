<?php
namespace App\Model;

use App\Core\Gateway;

class Bank extends Gateway
{
    public function createTable()
    {
        $sql = "CREATE TABLE IF NOT EXISTS users_banks (
            `id` INT PRIMARY KEY AUTO_INCREMENT,
            `user_id` INT NOT NULL,
            `bankname` VARCHAR(40) NOT NULL,
            `acctnum` VARCHAR(20) NOT NULL,
            `date_added` TIMESTAMP
        )";
        $this->run($sql);
    }

    public function addAcct($val)
    {
        $sql = "INSERT INTO users_banks (`user_id`,`bankname`,`acctnum`) VALUES ('$val')";
        return $this->run($sql);
    }

    public function getUserAcct($uid)
    {
        $sql = "SELECT * FROM users_banks, users WHERE `users_banks.user_id` = '$uid' ";
        return $this->fetch($sql);
    }

    public function getAllAccounts()
    {
        $sql = "SELECT * FROM `users_banks`, `users` WHERE `users_banks.user_id` = `users.id`";
        return $this->fetch($sql);
    }

    public function checkIfUserHasFilledBank($uid)
    {
        $sql = "SELECT * FROM users_banks WHERE `user_id` ='$uid' ";
        return $this->checkExists($sql);
    }
}
