<?php

use App\Models\Earning;
use App\Models\Share;

require_once 'autoload.php';

if (!isset($_POST['uid'])) {
    echo "<script>window.location = 'dashboard.php' </script>";
} else {
    Share::insert($_POST['uid'], $_POST['pid']);
} 