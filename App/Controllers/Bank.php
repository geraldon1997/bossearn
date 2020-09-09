<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Models\Bank as ModelsBank;

class Bank extends Controller
{
    public function add()
    {
        $data = ['userid' => USERID] + $this->postData;
        $result = ModelsBank::addBank($data);
        
        header('location:'.PREVIOUS_PAGE);
        return;
    }
}
