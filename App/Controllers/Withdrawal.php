<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Models\Withdrawal as ModelsWithdrawal;

class Withdrawal extends Controller
{
    public function add()
    {
        $type = $this->postData['withdraw'];
        return ModelsWithdrawal::addWithdrawal($type);
    }

    public function pay()
    {
        //
    }
}
