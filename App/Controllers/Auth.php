<?php
namespace App\Controllers;

use App\Core\Controller;

class Auth extends Controller
{
    
    public function login()
    {
        var_dump($this->postData);
    }

    public function register()
    {
        
    }
}