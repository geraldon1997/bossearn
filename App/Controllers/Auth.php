<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Models\Earning;
use App\Models\Point;
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

        $today = date('Y-m-d');
        $userId = $check[0]['id'];
        $lastLogin = $check[0]['last_login'];
        $subId = $check[0]['subscription_id'];
        $point = Point::point('subscription_id', $subId)[0]['daily_login'];

        if (count($check) < 1) {
            $this->error = 'User does not exist';
            return $this->view('login', ['error' => $this->error]);
        }
        
        if ($username !== $check[0]['username'] && $password !== $check[0]['password']) {
            $this->error = 'username or password incorrect';
            return $this->view('login', ['error' => $this->error]);
        }

        if ($check[0]['is_active'] == false && $check[0]['rold_id'] !== '1') {
            $_SESSION['uname'] = $username;
            header('location:'.ACTIVATION_PAGE);
           return;
        }

        if ($lastLogin !== $today) {
            $_SESSION['uname'] = $username;

            $previousPoint = Earning::bpoint();
            $newPoint = $point + $previousPoint;
            Earning::updateEarning('bpoint', $newPoint, $userId);
            header('location:'.HOME);
            return;
        }

        $_SESSION['uname'] = $username;
        header('location:'.HOME);
        return;
    }

    public function logout()
   {
        $s = $_SESSION['uname'];
        session_unset();
        header('location:'.LOGIN);
      
   }
}