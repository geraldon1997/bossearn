<?php
namespace App\Controller;

use App\Core\Config;
use App\Model\User;
use App\Model\Referral;

class UserController extends User
{
    private $data = [];
    public $errmsg = [];
    public $success = [];

    public function createUser($ref_id, array $values)
    {
        $this->data = $values;
        $this->cleanInput();
        $this->checkInput();
        $this->validateEmail();
        $this->validatePhone();
        $this->checkIfRegDetailsExist();
        $this->data['pass'] = $this->hashpwd($this->data['pass']);

        if (empty($this->errmsg)) {
            $checkRef = $this->checkRefCode($ref_id);
            if ($checkRef > 0) {
                $this->register(new Referral, $ref_id, $this->data);
            } else {
                $ref = $this->assignRef();
                $this->register(new Referral, $ref, $this->data);
            }
            $this->sendEmail($this->data['email'], 'welcome to bossearn', 'hello world');
            $this->success['register'] = 'registeration was successful';
        }
    }

    public function checkIfRegDetailsExist()
    {
        $u = $this->checkRegDetails('uname', $this->data['username']);
        $e = $this->checkRegDetails('email', $this->data['email']);

        if ($u > 0) {
            $this->errmsg['username'] = $this->data['username']." has been taken, choose another username";
        }

        if ($e > 0) {
            $this->errmsg['email'] = $this->data['email']." has been taken, choose another email";
        }
    }

    public function cleanInput()
    {
        foreach ($this->data as $key => $value) {
            $data = trim(htmlspecialchars(stripslashes(strip_tags($this->data[$key]))));
            $this->data[$key] = $data;
        }
    }

    public function checkInput()
    {
        foreach ($this->data as $key => $value) {
            if ($this->data[$key] = '' || $this->data[$key] === null || empty($this->data[$key])) {
                $msg = "$key should not be empty";
                $this->errmsg[$key] = $msg;
                unset($this->data[$key]);
            } else {
                $this->data[$key] = $value;
            }
        }
    }

    public function validateEmail()
    {
        $mail = $this->data['email'];
        $email = filter_var($mail, FILTER_VALIDATE_EMAIL);
        if ($email) {
            $this->data['email'] = $email;
        } else {
            $msg = $this->data['email']." is not a valid email address";
            $this->errmsg['email'] = $msg;
            unset($this->data['email']);
        }
    }

    public function validatePhone()
    {
        $phone = $this->data['phone'];
        $validPhone = filter_var($phone, FILTER_SANITIZE_NUMBER_INT);
        if ($validPhone) {
            $this->data['phone'] = $validPhone;
        } else {
            $msg = $phone." is not valid";
            $this->errmsg['phone'] = $msg;
            unset($this->data['phone']);
        }
    }

    public function hashpwd($pwd)
    {
        return md5($pwd);
    }

    public function login($data)
    {
        $this->data = $data;
        $this->cleanInput();
        $this->checkInput();
        $this->data['pwd'] = $this->hashpwd($this->data['pass']);
        $login = $this->checkLogin($this->data['username'], $this->data['pass']);

        if ($login > 0) {
            $this->success['login'] = "authentication was successful";
        } else {
            $this->errmsg['login'] = "username or password is incorrect";
        }
    }

    public function updateMyProfile($data)
    {
        $this->data = $data;
        $this->cleanInput();
        $this->checkInput();
        $uid = $this->findUser('uname', $_SESSION['uname'])['id'];
        $update = $this->updateProfile($this->data['fname'], $this->data['lname'], $this->data['phone'], $uid);

        if ($update === true) {
            $this->success['update'] = 'profile updated successfully';
        } else {
            $this->errmsg['update'] = 'profile was not updated';
        }
    }

    public function changePwd()
    {
        //
    }

    public function forgotPwd($email)
    {
        Config::loadConfFile('templates');
        $body = Config::get('email.forgotpwd');
        $this->sendEmail($email, 'Password Reset', $body);
    }

    public function resetPwd($data)
    {
        $this->data = $data;
        $this->cleanInput();
        $this->checkInput();
        $this->data['pwd'] = $this->hashpwd($this->data['pwd']);
        $this->updatePwd($this->data['pwd'], 'email', $this->data['email']);
    }

    public function sendEmail($email, $subject, $body)
    {
        $to = $email;
        $subject = 'subject';
        $message = $body;
        $headers .= "From: Support <support@bossearn.com>\n";
        $headers .= "X-Priority: 1\n";
        $headers .= "Content-Type:text/html; charset=\"iso-8859-1\"\n";
        mail($to, $subject, $message, $headers);
    }
}
