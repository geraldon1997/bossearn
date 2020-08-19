<?php
namespace App\Controllers;

use App\Models\Comment;
use App\Models\Coupon;
use App\Models\News;
use App\Models\Referral;
use App\Models\Subscription;
use App\Models\User;

class Seed
{
    public function __construct()
    {
        Subscription::subscriptionTable();
        User::usersTable();
        Referral::referralsTable();
        Coupon::couponsTable();
        News::newsTypeTable();
        News::newsTable();
        Comment::commentsTable();
    }
}