<?php
namespace App\Controllers;

use App\Core\Controller;

class Payment extends Controller
{
    public function success()
    {
        return 'payment recieved';
    }
}