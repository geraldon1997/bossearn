<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Models\Earning;
use App\Models\News;
use App\Models\Point;
use App\Models\Referral;
use App\Models\User;
use App\Models\Withdrawal;

class Page extends Controller
{
    public function index()
    {
        $news = News::normal();
        $recent = News::recentNormal();
        return $this->view('home', [$news, $recent]);
    }

    public function sponsored()
    {
        $news = News::sponsored();
        $recent = News::recentSponsored();
        return $this->view('sponsored', [$news, $recent]);
    }

    public function how()
    {
        return $this->view('how');
    }

    public function contact()
    {
        return $this->view('contact');
    }

    public function login()
    {
        return $this->view('login');
    }

    public function register()
    {
        return $this->view('register');
    }

    public function coupons()
    {
        return $this->view('coupons');
    }

    public function profile()
    {
        $profile = User::authinfo();
        return $this->view('profile', $profile);
    }

    public function users()
    {
        return $this->view('users');
    }

    public function addnews()
    {
        return $this->view('addnews');
    }

    public function referrals()
    {
        $userid = User::authid();
        $referrals = Referral::find(Referral::$table, 'referrer', $userid);

        return $this->view('referrals', $referrals);
    }

    public function earnings()
    {
        $earnings = Earning::authAll()[0];
        return $this->view('earnings', $earnings);
    }

    public function withdrawals()
    {
        $withdrawal = Withdrawal::find(Withdrawal::$table, 'users_id', USERID);
        return $this->view('withdrawals', $withdrawal);
    }

    public function bref()
    {
        $bref = Withdrawal::bref();
        return $this->view('bref', $bref);
    }

    public function bpoint()
    {
        return $this->view('bpoint');
    }
}
