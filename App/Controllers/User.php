<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Models\Earning;
use App\Models\Point;
use App\Models\Referral;
use App\Models\Subscription;
use App\Models\User as ModelsUser;

class User extends Controller
{
    
    public function register()
    {
        
        $refCode = self::generateReferralCode();

        if (empty($this->postData['subscription'])) {
            return $this->view('register', ['regError' => 'please choose subscription amount', 'data' => $this->postData]);
        }

        $ref = $this->postData['ref'];
        unset($this->postData['ref']);

        $this->validateForm();

        $this->postData = $this->postData + array('is_active' => 0);
        $this->postData['date'] = date('Y-m-d');
        $this->postData = array('ref' => $refCode) + $this->postData;
        
        
        if (!empty($this->error)) {
            return $this->view('register', ['data' => $this->postData, 'error' => $this->error]);
        }
        
        if (!empty($ref)) {
            $refExists = ModelsUser::is_ref_exists($ref);
            if ($refExists) {
                $referralId = Referral::id($ref);

                $register = ModelsUser::addUser($this->postData);

                if (!$register) {
                    $this->error = 'username or email already exists';
                    return $this->view('register', ['data' => $this->postData, 'regError' => $this->error]);
                }

                $user_id = ModelsUser::currentInsertedId($this->postData['username']);

                $referrals = [$referralId,$user_id];
                $addref = Referral::addReferral($referrals);
                
                $point = Point::point('id', $this->postData['subscription'])[0]['signup_bonus'];
                $addEarning = Earning::addEarning(['user_id', 'bpoint', 'bref'], [$user_id, $point, 0]);
                
                header('location:'.ACTIVATION_PAGE);
                $_SESSION['uname'] = $this->postData['username'];
                return;
            }
        }

        $register = ModelsUser::addUser($this->postData);

        if (!$register) {
            $this->error = 'username or email already exists';
            return $this->view('register', ['data' => $this->postData, 'regError' => $this->error]);
        }

        $user_id = ModelsUser::currentInsertedId($this->postData['username']);
        $point = Point::point('id', $this->postData['subscription'])[0]['signup_bonus'];
        $addEarning = Earning::addEarning(['user_id', 'bpoint', 'bref'], [$user_id, $point, 0]);

        if ($addEarning) {
            header('location:'.ACTIVATION_PAGE);
            $_SESSION['uname'] = $this->postData['username'];
            return;
        }
    }

    public static function generateReferralCode()
    {
        return rand(000000, 999999);
    }

    public function activation()
    {
        return $this->view('activation');
    }

    public function updateprofile()
    {
        $surname = $this->postData['surname'];
        $othernames = $this->postData['othernames'];
        $phone = $this->postData['phone'];

        ModelsUser::update(ModelsUser::$table, "surname = '$surname', othernames = '$othernames', phone = '$phone' ", 'id', USERID);
        
        header('location:'.PREVIOUS_PAGE);
        return;
    }

    public function updatedp()
    {
        $check = ModelsUser::exists(ModelsUser::$dptable, 'user_id', USERID);
        $image = $this->processImage();
        $columns = ModelsUser::columns(ModelsUser::$dptable);
        $data = ['userid' => USERID] + ['picture' => $image];
        
        if (!$check) {
            ModelsUser::insert(ModelsUser::$dptable, $columns, $data);
            header('location:'.PREVIOUS_PAGE);
            return;
        }

        ModelsUser::update(ModelsUser::$dptable, "picture = '$image' ", 'user_id', USERID);
        header('location:'.PREVIOUS_PAGE);
        return;
    }
}
