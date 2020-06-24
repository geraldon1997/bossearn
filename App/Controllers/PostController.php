<?php
namespace App\Controllers;

use App\Models\Post;

class PostController extends Post
{
    public static function createPost($data)
    {
        return Post::insert($data['title'], $data['body'], self::uploadHandler());
        // var_dump($data);
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

    public static function updatePost($data)
    {
        $file = $_FILES['image'];
        
        if (empty($file['name'])) {
            return self::updateWithoutImage($data['title'], $data['body'], $data['pid']);
        } else {
            return Post::updateWithImage($data['title'], $data['body'], self::uploadHandler(), $data['pid']);
        }
    }

    public static function viewAllPosts()
    {
         self::allPosts();
    }
}
