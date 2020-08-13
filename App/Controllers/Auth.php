<?php
namespace App\Controllers;

use App\Core\Controller;

class Auth extends Controller
{

    public function defaultPage()
    {
        return $this->view('login');
    }
    
    public function login()
    {
        $_SESSION['uname'] = 'mosco';
        header('location:'.HOME);
    }

    public function register()
    {
        var_dump($this->postData);
    }

    public function logout()
   {
        $s = $_SESSION['uname'];
        session_unset();
        header('location:'.LOGIN);
      
   }
}