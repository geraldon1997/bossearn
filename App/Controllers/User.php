<?php
namespace App\Controllers;

use App\Core\Controller;

class User extends Controller
{
    public $error;

    public function register()
    {
        if (empty($this->postData['couponAmountId'])) {
            return $this->view('register', ['regError' => 'please choose subscription amount', 'data' => $this->postData]);
        }
        $ref = $this->postData['ref'];
        $this->validateForm();
        $this->postData['ref'] = $ref;
        
        if (!empty($this->error)) {
            return $this->view('register', ['data' => $this->postData, 'error' => $this->error]);
        }
    }

    
}