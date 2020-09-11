<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Models\Bank;
use App\Models\Comment;
use App\Models\Coupon;
use App\Models\Earning;
use App\Models\Point;
use App\Models\Referral;
use App\Models\Subscription;
use App\Models\User as ModelsUser;
use App\Models\Withdrawal;

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

    public function viewUsers()
    {
        $data = $this->postData;
        $users = ModelsUser::view($data);
        return $this->view('users', $users);
    }

    public function edit()
    {
        $userid = $this->postData['userid'];
        $user = ModelsUser::find(ModelsUser::$table, 'id', $userid)[0];
        return $this->view('edituser', $user);
    }

    public function update()
    {
        $userid = $this->postData['userid'];
        $username = $this->postData['username'];
        $email = $this->postData['email'];

        ModelsUser::update(ModelsUser::$table, "username = '$username', email = '$email' ", 'id', "$userid");

        $user = ModelsUser::find(ModelsUser::$table, 'id', $userid)[0];
        return $this->view('edituser', $user);
    }

    public function makevendor()
    {
        $userid = $this->postData['userid'];
        ModelsUser::update(ModelsUser::$table, "role_id = '2' ", 'id', "$userid");
        header('location:'.USERS);
        return;
    }

    public function makeuser()
    {
        $userid = $this->postData['userid'];
        ModelsUser::update(ModelsUser::$table, "role_id = '3' ", 'id', "$userid");
        header('location:'.USERS);
        return;
    }

    public function delete()
    {
        $userid = $this->postData['userid'];
        ModelsUser::delete(ModelsUser::$table, 'id', $userid);
        Earning::delete(Earning::$table, 'user_id', $userid);
        Bank::delete(Bank::$table, 'user_id', $userid);
        Referral::delete(Referral::$table, 'referrer', $userid);
        ModelsUser::delete(ModelsUser::$dptable, 'user_id', $userid);
        Coupon::delete(Coupon::$table, 'user_id', $userid);
        Withdrawal::delete(Withdrawal::$table, 'users_id', $userid);
        Comment::delete(Comment::$table, 'user_id', $userid);

        header('location:'.USERS);
        return;
    }
}
