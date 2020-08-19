<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Models\Referral;
use App\Models\Subscription;
use App\Models\User as ModelsUser;

class User extends Controller
{
    
    public function register()
    {
        if (empty($this->postData['subscription'])) {
            return $this->view('register', ['regError' => 'please choose subscription amount', 'data' => $this->postData]);
        }
        $ref = $this->postData['ref'];
        unset($this->postData['ref']);
        $this->validateForm();
        $this->postData['ref'] = $ref;
        
        if (!empty($this->error)) {
            return $this->view('register', ['data' => $this->postData, 'error' => $this->error]);
        }
        
        ModelsUser::usersTable();

        Referral::referralsTable();
    }

    
}