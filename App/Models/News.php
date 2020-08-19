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
        $data .= "FOREIGN KEY (news_type_id) REFERENCES newstype(id)";

        return self::create(self::$newstable, $data);
    }
}