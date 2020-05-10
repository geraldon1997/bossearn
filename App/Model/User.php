<?php
namespace App\Model;

use App\Core\Gateway;
use App\Model\Referral;

class User extends Gateway
{
    public function createTable()
    {
        $sql = "CREATE TABLE IF NOT EXISTS `users` (
            `id` INT PRIMARY KEY AUTO_INCREMENT,
            `ref` INT UNIQUE NOT NULL,
            `fname` VARCHAR(20) NOT NULL,
            `lname` VARCHAR(20) NOT NULL,
            `email` VARCHAR(40) UNIQUE NOT NULL,
            `phone` VARCHAR(15) NOT NULL,
            `uname` VARCHAR(20) UNIQUE NOT NULL,
            `passwd` VARCHAR(40) NOT NULL,
            `is_email_verified` BOOLEAN NOT NULL,
            `is_logged_in` BOOLEAN NOT NULL,
            `date_joined` TIMESTAMP NOT NULL
            )";
        $this->run($sql);
    }

    public function register(Referral $refObj, int $ref_id, array $values)
    {
        $this->createTable();
        $ref = rand(0, 999999);
        $val = implode("', '", $values);
        $sql = "INSERT INTO users (ref,fname,lname,email,phone,uname,passwd,is_email_verified,is_logged_in) VALUES ($ref,'$val',false,false)";
        $register = $this->run($sql);
        $refuserid = $this->getLastId();
        $refid = $this->findUser('ref', $ref_id)['id'];
        if ($register === true) {
            return $refObj->addRef([$refid,$refuserid]);
        }
    }

    public function getLastId()
    {
        $sql = "SELECT * FROM users ORDER BY id DESC LIMIT 1";
        $lastid = $this->fetch($sql);
        foreach ($lastid as $key) {
            return $key['id'];
        }
    }

    public function findUser($col, $val)
    {
        $sql = "SELECT * FROM users WHERE $col = '$val' ";
        $user = $this->fetch($sql);
        foreach ($user as $key) {
            return $key;
        }
    }

    public function getAllUsers()
    {
        $sql = "SELECT * FROM users ORDER BY fname ASC";
        return $this->fetch($sql);
    }

    public function checkRegDetails($col, $val)
    {
        $sql = "SELECT * FROM users WHERE $col = '$val' ";
        return $this->checkExists($sql);
    }

    public function checkRefCode($refcode)
    {
        $sql = "SELECT * FROM users WHERE ref = '$refcode' ";
        return $this->checkExists($sql);
    }

    public function getUserDetails(string $un)
    {
        $sql = "SELECT * FROM users WHERE uname = '$un' ";
        return $this->fetch($sql);
    }

    public function addUsersBank(Bank $bank, $data)
    {
        $values = implode("', '", $data);
        return $bank->addAcct($values);
    }

    public function assignRef()
    {
        $sql = "SELECT ref FROM users ORDER BY RAND() LIMIT 1";
        $ref = $this->fetch($sql);
        foreach ($ref as $key) {
            return $key['ref'];
        }
    }

    public function checkLogin($un, $pwd)
    {
        $sql = "SELECT * FROM users WHERE uname = '$un' AND passwd = '$pwd' AND `is_email_verified` = true AND `is_logged_in` = false LIMIT 1";
        $login = $this->checkExists($sql);
        if ($login > 0) {
            $sql1 = "UPDATE `users` SET `is_logged_in` = true WHERE `uname` = '$un'";
            return $this->run($sql1);
        }
    }

    public function logout($un)
    {
        $sql = "SELECT * FROM `users` WHERE `uname` = '$un' AND `is_logged_in` = true LIMIT 1";
        $logout = $this->checkExists($sql);
        if ($logout > 0) {
            $sql1 = "UPDATE `users` SET `is_logged_in` = false WHERE `uname` = '$un'";
            return $this->run($sql1);
        }
    }

    public function isLoggedIn($un)
    {
        $sql = "SELECT * FROM `users` WHERE `uname` = '$un' AND `is_logged_in` = true";
        return $this->checkExists($sql);
    }

    public function updateProfile($fn, $ln, $ph, $uid)
    {
        $sql = "UPDATE users SET `fname` = '$fn', `lname` = '$ln', `phone` = '$ph' WHERE `id` = '$uid' ";
        return $this->run($sql);
    }

    public function updatePwd($pwd, $col, $val)
    {
        $sql = "UPDATE users SET `password` = '$pwd' WHERE $col = '$val' ";
        return $this->run($sql);
    }
}
