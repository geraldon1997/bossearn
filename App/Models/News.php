<?php
namespace App\Models;

use App\Core\QueryBuilder;

class News extends QueryBuilder
{
    public static $newstable = 'news';
    public static $newstypetable = 'newstype';

    public static function newsTypeTable()
    {
        $data = "id INT PRIMARY KEY AUTO_INCREMENT, ";
        $data .= "type VARCHAR(255) NOT NULL, ";
        $data .= "date_updated TIMESTAMP";

        return self::create(self::$newstypetable, $data);
    }

    public static function newsTable()
    {
        $data = "id INT PRIMARY KEY AUTO_INCREMENT, ";
        $data .= "news_type_id INT NOT NULL, ";
        $data .= "title VARCHAR(255) NOT NULL, ";
        $data .= "body LONGTEXT NOT NULL, ";
        $data .= "image TEXT NOT NULL, ";
        $data .= "date_updated TIMESTAMP, ";
        $data .= "FOREIGN KEY (news_type_id) REFERENCES newstype(id) ON UPDATE CASCADE ON DELETE CASCADE";

        return self::create(self::$newstable, $data);
    }

    public static function newsType()
    {
        return self::all(self::$newstypetable);
    }

    public static function addNews($values)
    {
        $columns = self::columns(self::$newstable);
        array_pop($columns);
        return self::insert(self::$newstable, $columns, $values);
    }

    public static function normal()
    {
        return self::findMultiple(self::$newstable, "news_type_id = 1 ORDER BY id DESC");
    }

    public static function recentNormal()
    {
        return self::findMultiple(self::$newstable, ("news_type_id = 1 ORDER BY id DESC LIMIT 5"));
    }

    public static function sponsored()
    {
        return self::findMultiple(self::$newstable, "news_type_id = 2 ORDER BY id DESC");
    }

    public static function recentSponsored()
    {
        return self::findMultiple(self::$newstable, ("news_type_id = 2 ORDER BY id DESC LIMIT 5"));
    }
}
