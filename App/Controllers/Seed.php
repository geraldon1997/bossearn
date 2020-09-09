<?php
namespace App\Controllers;

use App\Models\Bank;
use App\Models\Comment;
use App\Models\Coupon;
use App\Models\Earning;
use App\Models\News;
use App\Models\Payment;
use App\Models\Point;
use App\Models\Referral;
use App\Models\Role;
use App\Models\Subscription;
use App\Models\User;

class Seed
{
    public function __construct()
    {
        Role::rolesTable();
        Subscription::subscriptionTable();
        Point::pointsTable();
        User::usersTable();
        Referral::referralsTable();
        Coupon::couponsTable();
        News::newsTypeTable();
        News::newsTable();
        Comment::commentsTable();
        Earning::earningsTable();
        Payment::paymentsTable();
        Bank::banksTable();
        User::usersdpTable();
    }
}
