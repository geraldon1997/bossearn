<?php
namespace App\Models;

use App\Core\QueryBuilder;

class Share extends QueryBuilder
{
    public static $table = 'shares';

    public static function sharesTable()
    {
        $data = "id INT PRIMARY KEY AUTO_INCREMENT, ";
        $data .= "user_id INT NOT NULL, ";
        $data .= "news_id INT NOT NULL ";
        return self::create(self::$table, $data);
    }

    public static function addShare($values)
    {
        $columns = self::columns(self::$table);
        return self::insert(self::$table, $columns, $values);
    }

    public static function isShared($nid)
    {
        $userid = User::authid();
        $query = "SELECT * FROM ".self::$table." WHERE user_id = '$userid' AND news_id = '$nid' ";
        $result = self::check($query);

        if ($result) {
            return $result;
        }
        
        return false;
    }
}