<?php

use App\Models\Earning;

require_once 'autoload.php';

if (!isset($_POST['uid'])) {
    echo "<script>window.location = 'dashboard.php' </script>";
} else {
    Earning::updateBearn(50, $_POST['uid']);
}