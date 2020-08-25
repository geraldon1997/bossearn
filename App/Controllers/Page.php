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
        return $this->view('test');
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
}