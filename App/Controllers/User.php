<?php
namespace App\Controllers;

use App\Core\Controller;

class User extends Controller
{
    public function register()
    {
        var_dump($this->postData);
    }
}