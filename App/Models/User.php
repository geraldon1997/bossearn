<?php
namespace App\Models;

use App\Core\QueryBuilder;

class User extends QueryBuilder
{
    public static $table = 'users';
    public static $dptable = 'users_dp';

    public static function usersTable()
    {
        $data = "id INT PRIMARY KEY AUTO_INCREMENT, ";
        $data .= "ref VARCHAR(10) NOT NULL, ";
        $data .= "surname VARCHAR(40) NOT NULL, ";
        $data .= "othernames VARCHAR(100) NOT NULL, ";
        $data .= "email VARCHAR(100) UNIQUE NOT NULL, ";
        $data .= "phone VARCHAR(15) NOT NULL, ";
        $data .= "username VARCHAR(20) UNIQUE NOT NULL, ";
        $data .= "password VARCHAR(40) NOT NULL, ";
        $data .= "role_id TINYINT NOT NULL, ";
        $data .= "subscription_id TINYINT NOT NULL, ";
        $data .= "is_active BOOLEAN NOT NULL, ";
        $data .= "date_joined DATE NOT NULL, ";
        $data .= "FOREIGN KEY (subscription_id) REFERENCES subscriptions(id) ON UPDATE CASCADE ON DELETE CASCADE, ";
        $data .= "FOREIGN KEY (role_id) REFERENCES roles(id) ON UPDATE CASCADE ON DELETE CASCADE";

        return self::create(self::$table, $data);
    }

    public static function usersdpTable()
    {
        $data = "id INT PRIMARY KEY AUTO_INCREMENT, ";
        $data .= "user_id INT, ";
        $data .= "picture TEXT, ";
        $data .= "FOREIGN KEY (user_id) REFERENCES users(id) ON UPDATE CASCADE ON DELETE CASCADE";
        
        return self::create(self::$dptable, $data);
    }

    public static function addUser($values)
    {
        $date = date('Y-m-d');
        $columns = self::columns(self::$table);
        $values = $values + ['last_login' => $date];
        return self::insert(self::$table, $columns, $values);
    }

    public static function authid()
    {
        $result = self::find(self::$table, 'username', $_SESSION['uname']);
        return $result[0]['id'];
    }

    public static function currentInsertedId($username)
    {
        $result = self::find(self::$table, 'username', $username);
        return $result[0]['id'];
    }

    public static function authinfo()
    {
        $result = self::find(self::$table, 'username', $_SESSION['uname']);
        return $result[0];
    }

    public static function is_ref_exists($ref)
    {
        $result = self::exists(self::$table, 'ref', $ref);
        if ($result === 0) {
            return false;
        }
        return true;
    }

    public static function subscriptionId($id)
    {
        $sub = self::find(self::$table, 'id', $id);
        return $sub[0]['subscription_id'];
    }

    public static function activate($userId)
    {
        return self::update(self::$table, "is_active = TRUE", 'id', $userId);
    }

    public static function is_user_exists($id)
    {
        return self::exists(self::$table, 'id', $id);
    }

    public static function updateLastLogin($userId)
    {
        $date = date('Y-m-d');
        return self::update(self::$table, "last_login = '$date' ", 'id', $userId);
    }
}
