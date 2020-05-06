<?php
namespace App\Controller;

use App\Model\User;
use App\Model\Referral;

class UserController extends User
{
    private $data = [];
    public $errmsg = [];

    public function createUser($ref_id, $values)
    {
        $this->data = $values;
        $this->cleanInput();
        $this->checkInput();
        $this->validateEmail();
        $this->validatePhone();

        if (empty($this->errmsg)) {
            $this->register(new Referral, $ref_id, $this->data);
            $this->sendVerificationMail();
        }
    }

    public function sendVerificationMail()
    {
        $to = $this->data['email'];
        $subject = 'subject';
        $message = 'message';
        $headers = 'header';
        return mail($to, $subject, $message, $headers);
    }

    public function cleanInput()
    {
        foreach ($this->data as $key => $value) {
            $data = trim(htmlspecialchars(stripslashes(strip_tags($this->data[$key]))));
            $this->data[$key] = $data;
        }
        $this->checkInput();
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
        $this->validateEmail();
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
        $this->validatePhone();
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
}
