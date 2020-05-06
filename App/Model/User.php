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
            `ref` INT NOT NULL,
            `fname` VARCHAR(20) NOT NULL,
            `lname` VARCHAR(20) NOT NULL,
            `email` VARCHAR(40) UNIQUE NOT NULL,
            `phone` VARCHAR(15) NOT NULL,
            `uname` VARCHAR(20) UNIQUE NOT NULL,
            `password` VARCHAR(40) NOT NULL,
            `date_joined` TIMESTAMP NOT NULL
            )";
        $this->run($sql);
    }

    public function register(Referral $refObj, int $ref_id, array $values)
    {
        $this->createTable();
        $ref = rand(0, 999999);
        $val = implode("', '", $values);
        $sql = "INSERT INTO users (ref,fname,lname,email,phone,uname,`password`) VALUES ($ref,'$val')";
        $this->run($sql);
        $refuserid = $this->getLastId();
        $refid = $this->findUser('ref', $ref_id)['id'];
        return $refObj->addRef([$refid,$refuserid]);
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
        $sql = "SELECT * FROM users WHERE $col = '$val' LIMIT 1";
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

    public function checkRefCode($refcode)
    {
        $sql = "SELECT * FROM users WHERE ref = '$refcode' ";
        return $this->fetch($sql);
    }

    public function getUserDetails(string $un)
    {
        $sql = "SELECT * FROM users WHERE uname = '$un' ";
        return $this->fetch($sql);
    }

    public function addUsersBank(Bank $bank, $sql)
    {
        $bank->addAcct($sql);
    }
}
