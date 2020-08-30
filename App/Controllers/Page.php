<?php
namespace App\Controllers;

use App\Core\Controller;

class Page extends Controller
{
    public function index()
    {
        return $this->view('home');
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
        return $this->view('profile');
    }

    public function users()
    {
        return $this->view('users');
    }
}