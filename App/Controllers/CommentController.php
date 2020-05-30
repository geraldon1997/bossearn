<?php
namespace App\Controllers;

use App\Models\Comment;

class CommentController extends Comment
{
    public static function create($uid, $pid, $com)
    {
        return self::insert($uid, $pid, $com);
    }

    public static function view($pid)
    {
        $comment = self::findComment('post_id', $pid);
        foreach ($comment as $key) {
            $cid = $key['id'];
            $cuid = $key['user_id'];
            $cpid = $key['post_id'];
            $cc = $key['comment'];

            echo $cid.' '.$cuid.' '.$cpid.' '.$cc.'<br>';
        }
    }
}
