<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Models\Share as ModelsShare;

class Share extends Controller
{
    public function add()
    {
        $nid = $this->postData['nid'];
        $values = ['userid' => USERID] + $this->postData;
        $isshared = ModelsShare::isShared($nid);

        if (!$isshared) {
            return ModelsShare::addShare($values);
        }
    }
}
