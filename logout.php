<?php

require_once 'vendor/autoload.php';

use App\Controller\UserController;

$uc = new UserController;
$uc->logoutUser();
