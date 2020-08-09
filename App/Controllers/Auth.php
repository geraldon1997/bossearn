<?php
namespace App\Controllers;

use App\Models\Auth as ModelsAuth;

class Auth extends ModelsAuth
{
    public function login()
    {
        return $this->view('login');
    }

    public function register()
    {
        return $this->view('register');
    }
}