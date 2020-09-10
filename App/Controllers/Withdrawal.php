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
        
        $withdrawal = ModelsWithdrawal::find(ModelsWithdrawal::$table, 'users_id', USERID);
        

        if ($type === 'bref') {
            if (($refs % 3) != 0) {
                $error = ['error' => "<script>alert('withdrawal was not successful')</script>"];
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
        }
    }

    public function pay()
    {
        //
    }
}
