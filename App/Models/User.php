<?php
namespace App\Models;

use App\Models\Model;

class User extends Model
{
    public static function usersTable()
    {
        $data = "`id` INT PRIMARY KEY AUTO_INCREMENT,";
        $data .= "`name` VARCHAR(50) NOT NULL, ";
        $data .= "`email` VARCHAR(40) NOT NULL, ";
        $data .= "`password` VARCHAR(50) NOT NULL, ";
        $data .= "`is_email_verified` BOOLEAN NULL, ";
        $data .= "`joined_at` DATE, ";
        $data .= "`is_logged_in` BOOLEAN";
        return self::create('users', $data);
    }
    public static function shares()
    {
        return self::find('shares', $_SESSION['id']);
    }

    public static function profile()
    {
        return self::find('users', $_SESSION['id']);
    }

    public static function allUsers()
    {
        return self::all('users');
    }

    public static function allShares()
    {
        return self::all('shares');
    }
}
