<?php
namespace App\Controllers;

use App\Models\Post;

class PostController extends Post
{
    public static function createPost($data)
    {
        return Post::insert($data['title'], $data['body'], self::uploadHandler());
    }

    public static function uploadHandler()
    {
        $file = $_FILES['image'];
        $tmp = $file['tmp_name'];
        $name = $file['name'];

        if (!empty($file)) {
            return Post::uploadImage($tmp, $name);
        }
    }

    public static function updatePost()
    {
        //
    }
}
