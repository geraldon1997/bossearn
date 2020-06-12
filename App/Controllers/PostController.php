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

    public static function updatePost($data)
    {
        $file = $_FILES['image'];
        if (empty($file)) {
            return self::updateWithoutImage($data['title'], $data['body'], $data['pid']);
        } else {
            return Post::updateWithImage($data['title'], $data['body'], self::uploadHandler(), $data['pid']);
        }
    }

    public static function viewAllPosts()
    {
        $all = self::allPosts();
        foreach ($all as $key) {
            $pid = $key['id'];
            $pt = $key['title'];
            $pb = $key['body'];
            $pi = $key['image'];

            echo $pid.' '.$pt.' '.$pb.' '.$pi.'<br>';
        }
    }
}
