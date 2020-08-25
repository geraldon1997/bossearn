<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Models\User;

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

        $username = $this->postData['username'];
        $password = $this->postData['password'];

        $check = User::find(User::$table, 'username', $username);
        if (count($check) < 1) {
            return $this->view('login', ['error' => 'username or password does not exists']);
        }
        return count($check);
    }

    public function logout()
   {
        $s = $_SESSION['uname'];
        session_unset();
        header('location:'.LOGIN);
      
   }
}