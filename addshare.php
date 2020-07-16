<?php

use App\Models\Earning;
use App\Models\Share;
use App\Models\User;

require_once 'autoload.php';

$user = User::userId($_SESSION['uname'])[0]['id'];
if (!isset($user)) {
    echo "<script>window.location = 'dashboard.php' </script>";
} else {
    Share::insert($user, $_POST['pid']);
} 