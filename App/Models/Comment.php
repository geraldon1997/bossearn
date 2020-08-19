<?php
namespace App\Models;

use App\Core\QueryBuilder;

class Comment extends QueryBuilder
{
    public static $table = 'comments';

    public static function commentsTable()
    {
        $data = "id INT PRIMARY KEY AUTO_INCREMENT, ";
        $data .= "news_id INT NOT NULL, ";
        $data .= "user_id INT NOT NULL, ";
        $data .= "comment TEXT NOT NULL, ";
        $data .= "date_updated TIMESTAMP NOT NULL, ";
        $data .= "FOREIGN KEY (news_id) REFERENCES news(id), ";
        $data .= "FOREIGN KEY (user_id) REFERENCES users(id) ";

        return self::create(self::$table, $data);
    }

    public static function allComments()
    {
        return self::findMultiple(
            (self::$table.','.News::$newstable.','.User::$table),
            ("user_id = users.id AND news_id = 3")
        );
    }
}