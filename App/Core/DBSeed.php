<?php
namespace App\Core;

use App\Models\Bank;
use App\Models\Comment;
use App\Models\Coupon;
use App\Models\Earning;
use App\Models\Post;
use App\Models\Referral;
use App\Models\Role;
use App\Models\Share;
use App\Models\User;

class DBSeed
{
    public static function seed()
    {
        User::createTable();
        Referral::createTable();
        Bank::createTable();
        Earning::createTable();
        Post::createTable();
        Role::createTable();
        Comment::createTable();
        Coupon::createTable();
        Share::createTable();
    }
}
