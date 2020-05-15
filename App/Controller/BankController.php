<?php
namespace App\Controller;

use App\Model\Bank;
use App\Controller\UserController;

class BankController extends Bank
{
    public static function isBankFilled($un)
    {
        $userBank = Bank::checkIfUserHasFilledBank(UserController::getId($un));
        if ($userBank > 0) {
            return true;
        } else {
            return false;
        }
    }
}
