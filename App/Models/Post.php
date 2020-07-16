<?php
namespace App\Models;

use App\Core\Gateway;

class Post extends Gateway
{
    public static function createTable()
    {
        $sql = "CREATE TABLE IF NOT EXISTS posts (
        	`id` INT PRIMARY KEY AUTO_INCREMENT,
            `type` VARCHAR(20) NOT NULL,
            `title` TEXT NOT NULL,
            `body` LONGTEXT NOT NULL,
            `image` TEXT NOT NULL,
            `date` VARCHAR(50)
        )";
        Gateway::run($sql);
    }

    public static function insert($type, $title, $body, $image)
    {
        self::createTable();
        $body = addslashes($body);
        $date = time() + (60 * 60 * 24);
        $sql = "INSERT INTO posts (`type`, `title`,`body`,`image`,`date`) VALUES ('$type', '$title','$body','$image','$date')";
        return Gateway::run($sql);
    }

    public static function uploadImage($tmp, $name)
    {
        $path = "App/Assets/Images/Posts/";
        $path = $path . basename($name);
        $upload = move_uploaded_file($tmp, $path);
        if ($upload) {
            return $path;
        }
    }

    public static function updateWithImage($type, $title, $body, $image, $id)
    {
        $sql = "UPDATE `posts` SET `type` = '$type', `title` = '$title', `body` = '$body', `image` = '$image' WHERE `id` = '$id'";
        return Gateway::run($sql);
    }

    public static function updateWithoutImage($type, $title, $body, $id)
    {
        $sql = "UPDATE `posts` SET `type` = '$type', `title` = '$title', `body` = '$body' WHERE `id` = '$id'";
        return Gateway::run($sql);
    }

    public static function allPosts()
    {
        $sql = "SELECT * FROM `posts` ORDER BY id DESC";
        return Gateway::fetch($sql);
    }

    public static function findPost($col, $val)
    {
        $sql = "SELECT * FROM `posts` WHERE $col = '$val' ORDER BY `date` DESC";
        return Gateway::fetch($sql);
    }

    public static function deletePost($pid)
    {
        $sql = "DELETE FROM posts WHERE `id` = '$pid' ";
        return Gateway::run($sql);
    }

    public static function recentPost()
    {
        $sql = "SELECT * FROM posts WHERE `type` = 'blog' ORDER BY `date` DESC LIMIT 5";
        return Gateway::fetch($sql);
    }
}
