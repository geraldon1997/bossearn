<?php
namespace App\Controllers;

use App\Core\Controller;

class Auth extends Controller
{
    public $error;

    public function defaultPage()
    {
        return $this->view('login');
    }
    
    public function login()
    {
        $this->validateForm();
        if (!empty($this->error)) {
            return $this->view('login', ['error' => $this->error]);
        }
    }

    public function logout()
   {
        $s = $_SESSION['uname'];
        session_unset();
        header('location:'.LOGIN);
      
   }
}