<?php
require_once 'layout/header.php'; 

use App\Models\Earning;
use App\Models\User;

if (isset($_POST['withdraw'])) {
    $w = Earning::withdraw($_POST['withdraw'], User::userId($_SESSION['uname'])[0]['id']);

    
        header('location: dashboard.php');

}

require_once 'layout/footer.php';