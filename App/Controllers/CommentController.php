<?php
namespace App\Controllers;

use App\Models\Comment;
use App\Models\Earning;
use App\Models\User;

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
            $user = User::findUser('id', $cuid);

            $username = $user[0]['uname'];

            echo "<div class='blog-title-area'>";
            echo "<span class='color-yellow'>.by <strong>$username</strong></span>";
            echo "<p>$cc</p>";
            echo "</div>";
            echo "<hr>";
        }
    }
}
