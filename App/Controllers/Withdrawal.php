<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Models\Earning;
use App\Models\Referral;
use App\Models\Withdrawal as ModelsWithdrawal;

class Withdrawal extends Controller
{
    public function add()
    {
        $refs = Referral::allRefs();
        $type = $this->postData['type'];
        $amount = $this->postData['amount'];
        $bpoint = Earning::bpoint();
        $bref = Earning::bref(USERID);
        $earning = Earning::authAll()[0];
        $withdrawal = ModelsWithdrawal::find(ModelsWithdrawal::$table, 'users_id', USERID);
        
        if (empty($amount)) {
            $error = ['error' => "<script>alert('please choose amount to withdraw')</script>"];
            $data = $withdrawal + $error;
            return $this->view('withdrawals', $data);
        }

        if ($type === 'bref') {
            
            if (($refs % 3) != 0) {
                $error = ['error' => "<script>alert('withdrawal was not successful')</script>"];
                $data = $withdrawal + $error;
                return $this->view('withdrawals', $data);
            }

            if ($amount > $bref) {
                $error = ['error' => "<script>alert('you cannot withdraw above your earning')</script>"];
                $data = $withdrawal + $error;
                return $this->view('withdrawals', $data);
            }
        }
        
        if ($type === 'bpoint') {
            if ($amount < 10000) {
                $error = ['error' => "<script>alert('you are below minimum withdrawal amount')</script>"];
                $data = $withdrawal + $error;
                return $this->view('withdrawals', $data);
            }

            if ($bpoint < 10000) {
                $error = ['error' => "<script>alert('you are below minimum withdrawal amount')</script>"];
                $data = $withdrawal + $error;
                return $this->view('withdrawals', $data);
            }

            if ($amount > $bpoint) {
                $error = ['error' => "<script>alert('you cannot withdraw above your earning')</script>"];
                $data = $withdrawal + $error;
                return $this->view('withdrawals', $data);
            }

            if (!$earning['is_bpoint']) {
                $error = ['error' => "<script>alert('your withdrawal was not successful')</script>"];
                $data = $withdrawal + $error;
                return $this->view('withdrawals', $data);
            }
        }

        ModelsWithdrawal::addWithdrawal($type, $amount);
        $error = ['error' => "<script>alert('your withdrawal was successful')</script>"];
        $data = $withdrawal + $error;
        return $this->view('withdrawals', $data);
        
    }

    public function pay()
    {
        //
    }
}
