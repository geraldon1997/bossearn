<?php
namespace App\Models;

use App\Core\Gateway;

class Post extends Gateway
{
    public static function createTable()
    {
        $sql = "CREATE TABLE IF NOT EXISTS posts (
        	`id` INT PRIMARY KEY AUTO_INCREMENT,
            `title` VARCHAR(100) NOT NULL,
            `body` LONGTEXT NOT NULL,
            `image` TEXT NOT NULL,
            `date` TIMESTAMP
        )";
        Gateway::run($sql);
    }

    public static function insert($title, $body, $image)
    {
        self::createTable();
        $sql = "INSERT INTO posts (`title`,`body`,`image`) VALUES ('$title','$body','$image')";
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

    public static function updateWithImage($title, $body, $image, $id)
    {
        $sql = "UPDATE `posts` SET `title` = '$title', `body` = '$body', `image` = '$image' WHERE `id` = '$id'";
        return Gateway::run($sql);
    }

    public static function updateWithoutImage($title, $body, $id)
    {
        $sql = "UPDATE `posts` SET `title` = '$title', `body` = '$body' WHERE `id` = '$id'";
        return Gateway::run($sql);
    }

    public static function allPosts()
    {
        $sql = "SELECT * FROM `posts` ORDER BY id DESC";
        return Gateway::fetch($sql);
    }

    public static function findPost($col, $val)
    {
        $sql = "SELECT * FROM `posts` WHERE $col = '$val'";
        return Gateway::fetch($sql);
    }

    public static function deletePost($pid)
    {
        $sql = "DELETE FROM posts WHERE `id` = '$pid' ";
        return Gateway::run($sql);
    }

    public static function recentPost()
    {
        $sql = "SELECT * FROM posts ORDER BY `date` DESC LIMIT 5";
        return Gateway::fetch($sql);
    }
}
